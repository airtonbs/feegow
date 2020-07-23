<?php

require_once 'vendor/autoload.php';

$route = new App\Route;

//print_r($route->getUrl());
//echo '<hr>';
//print_r($route->getRoutes());

/*
class Especialidades {

	public $url = 'https://api.feegow.com.br/api/specialties/list?x-access-token=';
	const TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38';

	public function listarEspecialidades(){

		$curl = curl_init($this->url.Especialidades::TOKEN);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8"));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$retorno = curl_exec($curl);
		curl_close($curl);

		return $retorno;

	}

}

$list = new Especialidades;
$select = $list->listarEspecialidades();

$object = json_decode($select);

$array = (array)$object;

echo '<pre>';
print_r($array['content'][0]);
echo '</pre>';



/*
	$url = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38';



		$url = 'https://api.feegow.com.br/api/specialties/list?x-access-token='.$url;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8"));
		//curl_setopt($curl, CURLOPT_POST, false);
		//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
		$retorno = curl_exec($curl);
		curl_close($curl);
		//$xml = simplexml_load_string($retorno);
		//$code = $xml->code;
		echo '<pre>';
		print_r($retorno);
		echo '</pre>';
*/

?>