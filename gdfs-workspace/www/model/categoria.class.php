<?php 
//require_once("model/pdo_mysql.class.php");
require_once(realpath(dirname(__FILE__)) . "/../model/pdo_mysql.class.php");

class Categoria
{
	public function findAll(){
		$model = new PdoMysql();
		return $model->findAllCategoria();
	}
	
	public function getNomeCategoriaById($idCategoria){
		$model = new PdoMysql();
		return $model->getNomeCategoriaById($idCategoria);
	}
}

