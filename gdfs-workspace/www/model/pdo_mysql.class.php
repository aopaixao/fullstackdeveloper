<?php 
define('HOST', 'gd-fs-docker-mysql');  
define('DBNAME', 'gdfs');  
define('CHARSET', 'utf8');  
define('USER', 'gdfs');  
define('PASSWORD', 'gdsecret');  

Class PdoMysql {  

	private static $pdo;
	public function __construct() {} 

	public static function getInstance() 
	{  
		if (!isset(self::$pdo)) {  
			try {  
				$dsn = "mysql:host=". HOST . ";port=3306;dbname=" . DBNAME . ";user=" . USER . ";password=" . PASSWORD;
				self::$pdo = new \PDO($dsn);  
			} catch (PDOException $e) {  
				print "Erro: " . $e->getMessage();  
			}  
		}
		
		return self::$pdo;  
	}

	public function checkConexao(){
		$lPdo = $this->getInstance();
		$ok = true;
		
		$sql = "select curdate() from dual";

		$statement = $lPdo->prepare($sql);

		$statement->execute();

		$now = $statement->fetchColumn();

		$ok = ($now !== FALSE);
		
		return $ok;
	}

	public function getCidadeNome()
	{
		$lPdo = $this->getInstance();
  
		$stmt = $lPdo->query("SELECT
								nome
							FROM
								cidade
							ORDER BY
								nome
								");
					  
		$cidade = [];
		
		//var_dump($stmt->debugDumpParams());

		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			$cidade['nome'][] = $row['nome'];
		}
		
		$stmt->closeCursor(); 
		$stmt = null; 
		$lPdo = null;
		
		return $cidade;
	}
	
}