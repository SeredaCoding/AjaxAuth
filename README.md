
# AuthAjax

AjaxAuth é um sistema simples de autenticação (registro e login) desenvolvido em PHP orientado a objetos, utilizando jQuery e AJAX para uma experiência de usuário dinâmica e sem recarregamento da página.

# Tecnologias

- Backend: PHP (Orientação a Objetos).

- Frontend: jQuery, AJAX.

- Banco de dados: MySQL

## Funcionalidades
- Registro de usuários: Permite que novos usuários se registrem no sistema fornecendo informações como e-mail e senha.

- Login de usuários: Permite que os usuários já registrados façam login utilizando suas credenciais.

- Validação via AJAX: O sistema realiza a validação do formulário de registro e login via AJAX para evitar recarregamento da página.

- Armazenamento seguro de senhas: As senhas são armazenadas de forma segura utilizando hash.
## Instalação

Para rodar o AuthAjax em seu ambiente local ou servidor, siga os passos abaixo.

- Passo 1: Clonar o Repositório
Clone o repositório para o seu ambiente local. Utilize o comando abaixo para clonar o repositório AuthAjax:

        git clone https://github.com/SeredaCoding/AuthAjax.git

Configuração do Servidor Web:

Clone o projeto para o diretório raiz do seu servidor web, por exemplo:

- Para XAMPP: htdocs
- Para WAMP e Linux: www

Para outros servidores, ajuste conforme necessário.

- Passo 2: Configuração do Banco de Dados
Dentro da pasta clonada, vá até o diretório AjaxAuth/Api/dumps.

Importe o arquivo dump.sql para o seu servidor MySQL. Para isso, você pode utilizar ferramentas como phpMyAdmin ou fazer isso diretamente pelo terminal:


    mysql -u username -p < AjaxAuth/Api/dumps/dump.sql

Nota: O arquivo dump.sql irá criar automaticamente o banco de dados e as tabelas necessárias, não sendo necessário criar o banco manualmente.

Certifique-se de que o banco de dados foi criado corretamente e as tabelas estão configuradas.

- Passo 3: Configuração do arquivo .env

Após criar o banco, é necessário alterar as credenciais de acesso ao banco, conforme o que você definiu para ele em:

    /AuthAjax/Api/.env

    DB_NAME=ajaxauth
    DB_HOST=localhost
    DB_CHARSET=utf8
    DB_USER=root
    DB_PASS=123

- Passo 4: Descomentar .gitignore por segurança das informações

Descomentar as pastas do .gitignore fará com que o arquivo .env não vá junto com o upload dos arquivos para os servidores do github.

    /AuthAjax/.gitignore   

de:

    #.env

para:

    .env

Nota: A não ser que seja um banco local, por sigilo, não se deve publicar o arquivo .env do seu projeto, para que não aja acesso indevido.

- Passo 5: Executando o Sistema:

1. Inicie o Servidor Web e Banco de Dados

WAMP ou MAMP:

Abra o WAMP ou MAMP e inicie o Apache e o MySQL.

Linux:

    Inicie o Apache e o MySQL com os comandos:

    sudo systemctl start apache2
    sudo systemctl start mysql

2. Acesse o Sistema no Navegador

    No WAMP/MAMP ou Linux, abra seu navegador e vá para:

    http://localhost/AuthAjax/



# Pronto! Seu sistema AuthAjax está em funcionamento e já pode ser utilizando e adaptado de acordo com suas necessidades.


