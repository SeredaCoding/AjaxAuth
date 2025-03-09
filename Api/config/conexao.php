<?php
	require_once __DIR__ . '/config.php';
	loadEnv(__DIR__ . '/../.env');  // Carrega as variáveis do .env
	
	class Conexao{
		private $dbname,$host,$charset,$dsn,$user,$pass;
		private function setDbname($dbname){
			$this->dbname = $dbname;
		}
		private function setHost($host){
			$this->host = $host;
		}
		private function setCharset($charset){
			$this->charset = $charset;
		}
		private function setDsn($host,$db,$charset){
			$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
			$this->dsn = $dsn;
		}
		private function setUser($user){
			$this->user = $user;
		}
		private function setPass($pass){
			$this->pass = $pass;
		}

		private function getDbname(){
			return $this->dbname;
		}
		private function getHost(){
			return $this->host;
		}
		private function getCharset(){
			return $this->charset;
		}
		private function getDsn(){
			return $this->dsn;
		}
		private function getUser(){
			return $this->user;
		}
		private function getPass(){
			return $this->pass;
		}

		public function __construct()
		{
			// Configurações do banco de dados
			$this->setDbname($_ENV['DB_NAME']);
			$this->setHost($_ENV['DB_HOST']);
			$this->setCharset($_ENV['DB_CHARSET']);
			$this->setUser($_ENV['DB_USER']);
			$this->setPass($_ENV['DB_PASS']);
			$this->setDsn($this->getHost(),$this->getDbname(),$this->getCharset());
		}

		//Métodos específicos ----------------
		public function conectar(){
			try{
				$conexao = new PDO(
					$this->dsn,
					$this->user,
					$this->pass
				);

				$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//echo "Conexão bem sucedida!";
				return $conexao; // Retornar o objeto de conexão PDO

			}
			catch(PDOException $e){
				if(!isset($_SESSION)){
					session_start();
				}
				$_SESSION['mensagem'] = "Erro: " . $e->getMessage();
				die();
			}
		}
	}
?>