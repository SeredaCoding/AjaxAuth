<?php
header('Content-Type: application/json');
require_once(__DIR__ . '/config/conexao.php');

if (!isset($_COOKIE['auth_token'])) {
    echo json_encode(["success" => false, "error" => "Usuário não autenticado"]);
    exit;
}

$token = $_COOKIE['auth_token'];

try {
    $conn = new Conexao();
    $conexao = $conn->conectar();

    $stmt = $conexao->prepare("SELECT id, usuario FROM usuarios WHERE session_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(["success" => false, "error" => "Sessão inválida"]);
        exit;
    }

    echo json_encode(["success" => true, "message" => "Sessão válida", "usuario" => $user['usuario']]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erro no servidor"]);
}
?>
