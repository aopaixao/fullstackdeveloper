<?php 
require_once("model/pdo_mysql.class.php");

class Categoria
{
	public function findAll(){
		$model = new PdoMysql();
		return $model->findAllCategoria();
	}
}

