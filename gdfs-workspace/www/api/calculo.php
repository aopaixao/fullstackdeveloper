<?php
require_once(realpath(dirname(__FILE__)) . "/../model/cidade.class.php");
require_once(realpath(dirname(__FILE__)) . "/../model/pdo_mysql.class.php");
date_default_timezone_set('America/Sao_Paulo');

$objCalculo = new Calculo();
$objCalculo->preparaCalculo($_POST);

Class Calculo{

	public function preparaCalculo($post){
		$idCidade    = $post['id_cidade'];
		$idCategoria = $post['id_categoria'];
		$endOrigem   = $post['end_origem'];
		$endDestino  = $post['end_destino'];
		
		$distancia   = rand (0,100);
		$duracao     = rand (0,60);
		
		$objCidade = new Cidade();
		$dadosCalculo = $objCidade->getDadosCalculoTarifa(1, 1);
		
		$vrBandeirada = $dadosCalculo[0]['vr_bandeirada'];
		$vrHora       = $dadosCalculo[0]['vr_hora'];
		$vrKm         = $dadosCalculo[0]['vr_km'];
		
		$tarifa = $this->executaCalculo($vrBandeirada, $vrHora, $duracao, $vrKm, $distancia, $idCidade, $idCategoria, $endOrigem, $endDestino);
		
		$json = array(
			'id_cidade' => $idCidade,
			'id_categoria' => $idCategoria,
			'end_origem' => $endOrigem,
			'end_destino' => $endDestino,
			'distancia' => $distancia,
			'duracao'   => $duracao,
			'vr_bandeirada'   => $vrBandeirada,
			'vr_hora'   => $vrHora,
			'vr_km'   => $vrKm,
			'vr_calculado'   => $tarifa,
		);
		
		echo json_encode($json);
	}

	private function executaCalculo($vrBandeirada, $vrHora, $duracao, $vrKm, $distancia, $idCidade, $idCategoria, $endOrigem, $endDestino){
		$tarifa = null;
		$dataHoraAtual = date('Y/m/d H:i:s');
		
		$tarifa = $vrBandeirada + ($vrHora * $duracao) + ($vrKm * $distancia);

		$model = new PdoMysql();
		$model->postHistorico($vrBandeirada, $vrHora, $duracao, $vrKm, $distancia, $dataHoraAtual, $tarifa, $idCidade, $idCategoria, $endOrigem, $endDestino );

		return 'R$' . number_format($tarifa, 2, ',', '.');
	}

}