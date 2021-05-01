<?php
require_once(realpath(dirname(__FILE__)) . "/../model/cidade.class.php");
require_once(realpath(dirname(__FILE__)) . "/../model/categoria.class.php");
require_once(realpath(dirname(__FILE__)) . "/../model/pdo_mysql.class.php");
date_default_timezone_set('America/Sao_Paulo');

$objCalculo = new Calculo();
$post = json_decode($_POST['post_data'], true);
$objCalculo->preparaCalculo($post);

Class Calculo{

	public function preparaCalculo($post){
		$idCidade    = $post['id_cidade'];
		$idCategoria = $post['id_categoria'];
		$endOrigem   = $post['end_origem'];
		$endDestino  = $post['end_destino'];
		
		$distancia   = rand (0,100);
		$duracao     = rand (0,60);
		
		$objCidade = new Cidade();
		$objCategoria = new Categoria();
		$dadosCalculo = null;
		$dadosCalculo = $objCidade->getDadosCalculoTarifa($idCidade, $idCategoria);
		$dataHoraAtual = date('Y/m/d H:i:s');
		$horaAtual = date('H:i');
		
		$json = null;
		
		if(!isset($dadosCalculo) || !count($dadosCalculo) > 0){
			$json = array(
			'erro' => 'A combinação de Cidade e Categoria selecionados não existe.'
			);
		}else{
			$vrBandeirada = $dadosCalculo[0]['vr_bandeirada'];
			$vrHora       = $dadosCalculo[0]['vr_hora'];
			$vrKm         = $dadosCalculo[0]['vr_km'];
			
			$tarifa = $this->executaCalculo($vrBandeirada, $vrHora, $duracao, $vrKm, $distancia, $idCidade, $idCategoria, $endOrigem, $endDestino, $dataHoraAtual);
			
			$nomeCidade    = utf8_encode($objCidade->getNomeCidadeById($idCidade)[0]['nome']);
			$nomeCategoria = utf8_encode($objCategoria->getNomeCategoriaById($idCategoria)[0]['nome']);
			
			$json = array(
				'id_cidade' => $idCidade,
				'nome_cidade' => $nomeCidade,
				'id_categoria' => $idCategoria,
				'nome_categoria' => $nomeCategoria,
				'end_origem' => $endOrigem,
				'end_destino' => $endDestino,
				'distancia' => $distancia,
				'duracao'   => $duracao,
				'vr_bandeirada'   => $vrBandeirada,
				'vr_hora'   => $vrHora,
				'vr_km'   => $vrKm,
				'vr_calculado'   => $tarifa,
				'hora_atual'   => $horaAtual,
			);
		}
		
		echo json_encode($json);
	}

	private function executaCalculo($vrBandeirada, $vrHora, $duracao, $vrKm, $distancia, $idCidade, $idCategoria, $endOrigem, $endDestino, $dataHoraAtual){
		$tarifa = null;
		
		$tarifa = $vrBandeirada + ($vrHora * $duracao) + ($vrKm * $distancia);

		$model = new PdoMysql();
		$model->postHistorico($vrBandeirada, $vrHora, $duracao, $vrKm, $distancia, $dataHoraAtual, $tarifa, $idCidade, $idCategoria, $endOrigem, $endDestino );

		return 'R$' . number_format($tarifa, 2, ',', '.');
	}

}