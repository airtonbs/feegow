<?php

namespace App\Models;

use MF\Api\Api;
use MF\Authentication\Cpf;
use MF\Bd\Connection;
// Class responsável por realizar uma requisição via ajax com os dados do formulário de agendamento e realizar cadastro no banco de dados
Class Agendamento {
	// Atributo com a url utilizada para execução da API via ajax
	//  Parâmetro do token x-access-token=
	const URL = 'https://api.feegow.com.br/api/patient/list-sources?';
	// Atributo responsável por enviar parâmetros na url da API
	private $parametros = null;
	// Método que eesgatar informações de source_id (GET /patient/list-sources) para preencher o select "Como conheceu" do formulário dos dados do paciente
	public function patientListSource() {

		$parametros = [];
		// Class responsável por enviar a requisição ajax
		$ajax = new Api;
		$list = $ajax->ajax(Agendamento::URL, $parametros);
		// Recebe dados da API do agendamento para serem cadastrados no banco de dados
		return $dados = $list;
	}
	// Método que envia uma requisição via ajax para agendamento do paciente
	public function agendar(){
		// Valida CPF
		$cpf = new Cpf;
		$cpf = Cpf::validaCpf($_POST['cpf']);
		// Condição que autoriza criação do registro no banco de dados
		if($cpf !=false){
			// Conexão com o banco de dados
			$sql = new Connection;
			// Guardando dados no banco de dados
			$create = $sql->select(
				"CALL sp_schedule_create(:ESPECIALIDADE, :PROFISSIONAL, :SOURCE, :NOME, :NASCIMENTO, :CPF)",
				 array(
				 // Dados 
        		":ESPECIALIDADE"=>$_POST['specialty_id'],
        		":PROFISSIONAL"=>$_POST['professional_id'],
        		":SOURCE"=>$_POST['source_id'],
        		":NOME"=>$_POST['name'],
        		":NASCIMENTO"=>$_POST['birthdate'],
        		":CPF"=>$_POST['cpf']

			));
	        // Condição que verifica se criou no banco de dados
	        if($create == false){
	        	// Retorna para o formulário solicitando que tente novamente
	        	return $create['erro'] = 'connection';
	        }
	        // Retorna dados cadastrados no banco de dados
	        return $create;

	    }else{ 
	    	// Retorna para formulário informando CPF inválido
	    	return $erro['erro'] = 'cpf';
	    }
	}
}

?>