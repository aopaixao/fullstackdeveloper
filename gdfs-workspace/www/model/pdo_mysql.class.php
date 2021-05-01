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
	
	public function findAllCidade(){
		$lPdo = $this->getInstance();
  
		$stmt = $lPdo->prepare("SELECT
								id, nome
							FROM
								cidade
							ORDER BY
								nome
								");
					  
		$stmt->execute();
		
		$cidade = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $cidade;
	}
	
	public function findAllCategoria(){
		$lPdo = $this->getInstance();
  
		$stmt = $lPdo->prepare("SELECT
								id, nome
							FROM
								categoria
							ORDER BY
								nome
								");
					  
		$stmt->execute();
		
		$categoria = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $categoria;
	}
	
	public function getDadosCalculoTarifa($idCidade, $idCategoria){
		$lPdo = $this->getInstance();
  
		$stmt = $lPdo->prepare("SELECT
								vr_bandeirada, vr_hora, vr_km
							FROM
								cidade_categoria
							WHERE 
								id_cidade = $idCidade
							AND 
								id_categoria = $idCategoria
								");
					  
		$stmt->execute();
		
		$dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $dados;
	}
	
	public function postHistorico($vrBandeirada, $vrHora, $duracao, $vrKm, $distancia, $dataHoraAtual, $tarifa, $idCidade, $idCategoria, $endOrigem, $endDestino ){
		$lPdo = $this->getInstance();
		
		$query = "INSERT INTO
		historico_calculo (data_hora_calculo, id_cidade, id_categoria, endereco_origem, endereco_destino, distancia, duracao_minuto, valor_calculado)
		VALUES('$dataHoraAtual', $idCidade, $idCategoria, '$endOrigem', '$endDestino', '$distancia', $duracao, '$tarifa')
		";
		
		$rowsInsert = $lPdo->exec($query);   
		
		return $rowsInsert;
		
	}
	
}