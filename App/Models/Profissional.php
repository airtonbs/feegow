<?php

namespace App\Models;

use MF\Api\Api;
// Class responsável por realizar uma requisição via ajax para obter informações dos proficionais
Class Profissional {
	// Atributo com a url utilizada para execução da API via ajax
	const URL = 'https://api.feegow.com.br/api/professional/list?';
	// Envia uma requisição via ajax sollicitando uma lista de especialidades
	public function listarprofissionais(){
		// Parametros enviados na url ajax
		$parametros['especialidade_id'] = $_POST['especialidade_id'];
		// Class responsável por enviar a requisição ajax
		$ajax = new Api;
		$list = $ajax->ajax(Profissional::URL, $parametros);

		return $list;
	}
}

?>