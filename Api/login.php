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

try {
    $conn = new Conexao();
    $conexao = $conn->conectar();

    $stmt = $conexao->prepare("SELECT id, usuario, senha FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        // Gerar um token único
        $token = bin2hex(random_bytes(32));

        // Armazenar o token no banco
        $stmt = $conexao->prepare("UPDATE usuarios SET session_token = :token WHERE id = :id");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id', $user['id']);
        $stmt->execute();

        // Definir o cookie seguro
        setcookie("auth_token", $token, time() + 3600, "/", "", false, true); // Expira em 1 hora, HTTPOnly ativado

        echo json_encode(["success" => true, "message" => "Login bem-sucedido"]);
        exit;
    } else {
        echo json_encode(["success" => false, "error" => "Credenciais inválidas"]);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erro no servidor"]);
    exit;
}
