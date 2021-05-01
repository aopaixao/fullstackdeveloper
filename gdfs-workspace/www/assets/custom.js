$("#btnExecutar").click(function(e) {

    e.preventDefault();
	
	if($('#selectCidades').val() == 0){
		alert('Selecione a Cidade');
		return;
	}else if($('#selectCategorias').val() == 0){
		alert('Selecione a Categoria');
		return;
	}else if($('#inputEndOrigem').val() == ''){
		alert('Informe o endereço de origem');
		return;
	}else if($('#inputEndDestino').val() == ''){
		alert('Informe o endereço de destino');
		return;
	}

	var data={
		'id_cidade' : $('#selectCidades').val(),	
		'id_categoria' : $('#selectCategorias').val(),	
		'end_origem' : $('#inputEndOrigem').val(),	
		'end_destino' : $('#inputEndDestino').val(),	
	}

    $.ajax({
        type    : 'post', 
        cache   : false,
        url     : 'api/calculo.php',
        data    : {post_data:JSON.stringify(data)},
        success: function(resp) {
			response = $.parseJSON(resp);
			
			if(response.erro){
				$('.container_estimativa').append('<p>'+response.erro+'</p>');
			}else{
				$('.container_estimativa').append('<p>Em '+ response.nome_cidade + ', ' +response.nome_categoria+ ', de ' +response.end_origem+ ' para ' +response.end_destino+' , às ' + response.hora_atual+ ': <b>'+response.vr_calculado+'</b>.</p>');
			}
			
        }
    });
	
});