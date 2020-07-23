<?php

namespace MF\Api;
// Class responsável por enviar requisições ajax
Class Api {
	// Token de acesso da API
	const TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38';
	// Método mágico que executa a API e retorna os dados
	public function ajax($url, $array) {
		// Incluindo dados de token na variável $array com os parâmetros que devem ser enviados para requisição
		$array['x-access-token'] = Api::TOKEN;
		// Converte a variável $_POST em parâmetros da url
		$parametros = http_build_query($array);
		$url = $url.$parametros;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8"));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$retorno = curl_exec($curl);
		curl_close($curl);

		return $retorno;
	}
}

?>