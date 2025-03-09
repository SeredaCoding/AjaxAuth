<?php
require_once(__DIR__ . '/config/conexao.php');
header('Content-Type: application/json');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "error" => "Método HTTP inválido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

if (empty($email) || empty($senha)) {
    echo json_encode(["success" => false, "error" => "Preencha todos os campos"]);
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_BCRYPT);
$token = bin2hex(random_bytes(32));

try {
    $conn = new Conexao();
    $conexao = $conn->conectar();

    // Verificar se o e-mail já existe
    $stmt = $conexao->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->fetchColumn() > 0) {
        echo json_encode(["success" => false, "error" => "E-mail já cadastrado"]);
        exit;
    }

    // Gerar nome de usuário único
    $nomeUsuarioBase = strstr($email, '@', true);
    $nome_usuario = $nomeUsuarioBase;
    $stmt = $conexao->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
    $contador = 1;

    do {
        $stmt->execute([$nome_usuario]);
        $existe = $stmt->fetchColumn();
        if ($existe) {
            $nome_usuario = $nomeUsuarioBase . $contador;
            $contador++;
        }
    } while ($existe);

    // Inserir no banco de dados com token
    $stmt = $conexao->prepare("INSERT INTO usuarios(email, senha, usuario, session_token) VALUES (:email, :senha, :usuario, :token)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senhaHash);
    $stmt->bindParam(':usuario', $nome_usuario);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    // Definir o cookie seguro
    setcookie("auth_token", $token, time() + 3600, "/", "", false, true);

    echo json_encode(["success" => true, "message" => "Registro bem-sucedido"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erro no servidor"]);
}

