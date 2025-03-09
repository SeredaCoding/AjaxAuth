CREATE DATABASE IF NOT EXISTS ajaxauth CHARACTER SET utf8 COLLATE utf8_general_ci;
USE ajaxauth;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    usuario VARCHAR(255) NOT NULL UNIQUE,
    session_token VARCHAR(255) NULL;
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);