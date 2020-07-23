<?php
namespace MF\Bd;

// Variaveis para conexão ao Banco de Dados
class Connection {

	//Conexão locallhost
	const HOSTNAME = "127.0.0.1";
	const USERNAME = "root";
	const PASSWORD = "";
	const DBNAME = "db_vitallife";

	private $conn;
	
	// Função automática Publica - Toda vez que chamarem a class Sql ela faz conex? ao Banco de Dados
	public function __construct() {
		// Condição que verifica se ouve algo errado na conexão com o banco. Caso tenha retornado erro, esse erro pode ser tratado de forma personalizada.
		try {
			// Istanciando a class PDO com dados da conexão
			$this->conn = new \PDO
			('mysql:host='.Connection::HOSTNAME.';dbname='.Connection::DBNAME.';charset=utf8', 
					Connection::USERNAME,
					Connection::PASSWORD
			);
		} catch (PDOException $e){
			//.. Tratar de alguma forma erros ..//
		}
	}

	//Verifica o conteúdo enviado para o Banco de dados evitando enviarem conteúdo indesejado
	private function setParams($statement, $parameters = array()) {
		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}
	// Verificando os parâmetros
	private function bindParam($statement, $key, $value) {

		$statement->bindParam($key, $value);

	}

	// somente executa no Banco
	public function query($rawQuery, $params = array())	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	// Executa e retorna uma resposta
	public function select($rawQuery, $params = array()):array {

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_OBJ);// Retorna um Objeto
		//return $stmt->fetchAll(\PDO::FETCH_ASSOC);// Retorna Array multidimencional

	}

}

 ?>