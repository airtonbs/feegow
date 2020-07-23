<?php

namespace App\Controllers;

use MF\Controller\Action;
use App\Models\Especialidade;
use App\Models\Profissional;
use App\Models\Agendamento;

// Class que controla as páginas dentro do diretório index
// Class deve somente conter métodos funcionais relativos a própria class
class IndexController extends Action{
	// Método que faz o tratamento da página index.phtml
	public function index() {
		// Conexão com o banco de dados
		$list = new Especialidade;
		$select = $list->listarEspecialidades();

		$json = json_decode($select);

		// Array com conteúdo a ser utilizado dentro da página index.phtml, sendo atribuido ao objeto $view
		$this->view->dados = $json;
		// Encaminhando o nome da página para o método render() renderizar a página
		$this->render('index', 'layout');
	}

	// Método que faz o tratamento da página index.phtml
	public function profissional() {
		// Class responsável por enviar dados via ajax consultando lista de profissionais
		$proficional = new Profissional;
		$select = $proficional->listarprofissionais();
		// Condição que verifica se a requisição foi um sucesso ou algo deu errado
		if(!$select){

			$json['erro'] = 'Algo deu errado! Tente novamente mais tarde!';

			$pagina = 'index';

		}else{
			// Decodificando a resposta json
			$json = json_decode($select);
			// Contando quantos profissionais foram encontrados
			$count = count($json->content);
			// Incluindo a quantidade de profissionais encontrados no objeto a ser utilizado na página renderizada
			$this->view->encontrados = $count;

			$pagina = 'profissional';
		}
		// Array com conteúdo a ser utilizado dentro da página index.phtml, sendo atribuido ao objeto $view
		$this->view->dados = $json;
		// Encaminhando o nome da página para o método render() renderizar a página
		$this->render($pagina, 'layout');
	}

	// Método que faz o tratamento da página index.phtml
	public function comoConheceu() {
		// Class responsável por enviar dados via Ajax e guardar dados de agendamento do paciente no banco de dados
		$agendamento = new Agendamento;
		$select = $agendamento->patientListSource();

		// Condição que verifica se a requisição foi um sucesso ou algo deu errado
		if(!$select){

			$json['erro'] = 'Algo deu errado! Tente novamente mais tarde!';

			$pagina = 'index';

		}else{
			// Decodificando a resposta json
			$json = json_decode($select);

			$pagina = 'agendamento';
		}
		// Array com conteúdo a ser utilizado dentro da página index.phtml, sendo atribuido ao objeto $view
		$this->view->dados = $json;
		// Encaminhando o nome da página para o método render() renderizar a página
		$this->render($pagina, 'layout');
	}

	// Método que faz o tratamento da página index.phtml
	public function agendamento() {
		// Class responsável por enviar dados via Ajax e guardar dados de agendamento do paciente no banco de dados
		$agendamento = new Agendamento;
		$select = $agendamento->agendar();
//print_r($select);die;
		// Condição que verifica se foi guardado no banco de dados
		if(!isset($select[0]->schedule_id)){

			if($select == 'connection' || $select == 'cpf'){
				// Tratando o erro vindo da tentativa de guardar os dados no banco de bados
				if($select == 'connection'){
					$json['erro'] = 'Algo deu errado! Tente novamente mais tarde!';
				}else{
					$json['erro'] = 'CPF inválido!';
				}				

			}else{
				// Decodificando a resposta json
				$json = json_decode($select);
			}

			$pagina = 'agendamento';

		}else{

			$select[0]->success = true;

			$json = $select;

			$pagina = 'dados';
		}

		// Array com conteúdo a ser utilizado dentro da página index.phtml, sendo atribuido ao objeto $view
		$this->view->dados = $json;
		// Encaminhando o nome da página para o método render() renderizar a página
		$this->render($pagina, 'layout');
	}
}

?>