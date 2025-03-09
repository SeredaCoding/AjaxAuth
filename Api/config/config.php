<?php
    function loadEnv($filePath) {
        if (!file_exists($filePath)) {
            throw new Exception("Arquivo .env não encontrado em: {$filePath}");
        }

        // Carrega o arquivo e percorre as linhas
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignora linhas de comentário
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Separa chave e valor
            $parts = explode('=', $line, 2);
            if (count($parts) !== 2) {
                continue;
            }

            $key = trim($parts[0]);
            $value = trim($parts[1]);

            // Define a variável no ambiente
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
        }
    }
?>