<?php
header('Content-Type: application/json');
require_once(__DIR__ . '/config/conexao.php');

session_start();

// Verifica se o usuário está autenticado
if (!isset($_COOKIE['auth_token'])) {
    echo json_encode(["success" => false, "error" => "Usuário não autenticado"]);
    exit;
}

// Obtém o token do cookie
$token = $_COOKIE['auth_token'];

try {
    $conn = new Conexao();
    $conexao = $conn->conectar();

    // Remove o token do banco de dados
    $stmt = $conexao->prepare("UPDATE usuarios SET session_token = NULL WHERE session_token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    // Expira o cookie no navegador
    setcookie("auth_token", "", time() - 3600, "/", "", false, true);

    // Destroi a sessão
    session_unset();
    session_destroy();

    echo json_encode(["success" => true, "message" => "Logout realizado com sucesso"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => "Erro no servidor"]);
}
?>