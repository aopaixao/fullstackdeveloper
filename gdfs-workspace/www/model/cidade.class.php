<?php 
//require_once("model/pdo_mysql.class.php");
require_once(realpath(dirname(__FILE__)) . "/../model/pdo_mysql.class.php");

class Cidade
{
	public function findAll(){
		$model = new PdoMysql();
		return $model->findAllCidade();
	}
	
	public function getDadosCalculoTarifa($idCidade, $idCategoria){
		$model = new PdoMysql();
		return $model->getDadosCalculoTarifa($idCidade, $idCategoria);
	}
	
	public function getNomeCidadeById($idCidade){
		$model = new PdoMysql();
		return $model->getNomeCidadeById($idCidade);
	}
}

