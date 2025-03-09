<?php
require_once(__DIR__.'\views\snippets\header.html');
require_once(__DIR__.'\views\snippets\check_session.html');
require_once(__DIR__.'\views\snippets\logout.html');
?>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center">
        <div class="card shadow p-4">
            <h2 class="text-success">Login realizado com sucesso!</h2>
            <p>Bem-vindo ao sistema.</p>
            <button id="logout-btn" class="btn btn-danger mt-3">Sair</button>
        </div>
    </div>
</body>
</html>