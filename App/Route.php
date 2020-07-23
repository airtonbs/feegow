<?php

namespace App;
// Carregando a class Bootstrap
use \MF\Init\Bootstrap;
// Class que faz toda tratativa de rotas
class Route extends Bootstrap {
	// Método que cria meu array de rotas
	protected function initRoutes() {
		// Array da rota principal
		$routes['home'] = array(
			'route' => '/',// Rota digitada no browser
			'controller' => 'IndexController',// Class que controla os fluxos das requisições
			'action' => 'index'// Método utilizado dentro da class
		);
		// Rota para selecionar profissional
		$routes['profissional'] = array(
			'route' => '/profissional',// Rota digitada no browser
			'controller' => 'IndexController',// Class que controla os fluxos das requisições
			'action' => 'profissional'// Método utilizado dentro da class
		);
		// Rota para resgatar dados do select como conheceu no formulário de agendamento
		$routes['source'] = array(
			'route' => '/source',// Rota digitada no browser
			'controller' => 'IndexController',// Class que controla os fluxos das requisições
			'action' => 'comoConheceu'// Método utilizado dentro da class
		);
		// Rota para agendamento
		$routes['agendamento'] = array(
			'route' => '/agendamento',// Rota digitada no browser
			'controller' => 'IndexController',// Class que controla os fluxos das requisições
			'action' => 'agendamento'// Método utilizado dentro da class
		);
		// Modifica o atributo routes pelo método setRoutes()
		$this->setRoutes($routes);
	}

}

?>