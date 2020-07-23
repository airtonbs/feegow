<?php

namespace App\Models;

use MF\Api\Api;

Class Especialidade {
	// Atributo com a url utilizada para execução da API via ajax
	//const URL = 'https://api.feegow.com.br/api/specialties/list?x-access-token=';
	const URL = 'https://api.feegow.com.br/api/specialties/list?';
	// Envia uma requisição via ajax sollicitando uma lista de especialidades
	public function listarEspecialidades(){
		// Parametros enviados na url ajax
		$parametros = [];
		// Class responsável por enviar a requisição ajax
		$ajax = new Api;
		$list = $ajax->ajax(Especialidade::URL, $parametros);

		return $list;
	}
}

?>