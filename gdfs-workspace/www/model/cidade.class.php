<?php 
require_once("model/pdo_mysql.class.php");

class Cidade
{
	public function findAll(){
		$model = new PdoMysql();
		return $model->findAllCidade();
	}
}

