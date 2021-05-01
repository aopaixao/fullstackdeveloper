<?php
require_once("model/pdo_mysql.class.php");
$model = new PdoMysql();

$ok = $model->checkConexao();

//$nomeCidade = utf8_encode($model->getCidadeNome()['nome'][0]);
/**
echo "<pre>";
print_r($model->findAllCidade());
echo "</pre>";
/**/
?>
<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/custom.css">
    <title>Gaudium Software - Prova Desenvolvedor Full Stack</title>
</head>
<body>
<main role="main">
    <div class="container mx-auto">
        <div class="row">
            <h1 class="mx-auto"><img src="assets/gaudium-logo.png" alt="Gaudium logo" width=100/> Gaudium Software</h1>
        </div>
        <div class="row">
            <h2 class="mx-auto">Prova Desenvolvedor Full Stack</h2>
        </div>
		<div class="row mt-5">
			<div class="col-sm container_form">
				<form>
				  <div class="mb-3">
					<label for="selectCidades" class="form-label">Cidades</label>
					<select class="form-control" id="selectCidades" name="id_cidade">
						<?php
							$cidades = $model->findAllCidade();
							foreach($cidades as $cidade):
						?>
							<option value="<?php echo $cidade['id'];?>"><?php echo utf8_encode($cidade['nome']);?></option>
						<?php endforeach;?>
					</select>
				  </div>
				  <div class="mb-3">
					<label for="selectCategorias" class="form-label">Categorias</label>
					<select class="form-control" id="selectCategorias" name="id_categoria">
						<?php
							$categorias = $model->findAllCategoria();
							foreach($categorias as $categoria):
						?>
							<option value="<?php echo $categoria['id'];?>"><?php echo utf8_encode($categoria['nome']);?></option>
						<?php endforeach;?>
					</select>
				  </div>
				  <div class="mb-3">
					<label for="inputEndOrigem" class="form-label">Endereço de Origem</label>
					<input type="text" class="form-control" id="inputEndOrigem" name="end_origem">
				  </div>
				  <div class="mb-3">
					<label for="inputEndDestino" class="form-label">Endereço de Destino</label>
					<input type="text" class="form-control" id="inputEndDestino" name="end_destino">
				  </div>
				  <button type="submit" class="btn btn-primary" id="btnExecutar">Executar Estimativa</button>
				</form>				
			</div>            
			<div class="col-sm container_estimativa">
				<p>
					Em Rio de Janeiro, carro executivo, de Rua da Assembléia, 10 para Rua Barata Ribeiro, 30, às 10:34: <b>R$ 23,15</b>.
				</p>
			</div>            
        </div>
    </div> <!-- /container -->
</main>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>