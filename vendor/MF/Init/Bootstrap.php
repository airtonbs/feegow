<?php

namespace MF\Init;

// Class que herda os métodos da class Route
abstract class Bootstrap {
	private $routes;
	// Método abstrato initRoutes()
	abstract protected function initRoutes();
	// Método mágico iniciado apartir da instancia da class
	public function __construct() {
		// Executa o método initRoutes iniciando as rotas
		$this->initRoutes();
		// Executa o método run() enviando para este método a rota digitada no browser retornada pelo método getUrl()
		// O método run() retorna os dados da rota em um array com a respectiva class controller instanciada e a ação que deve ser tomada dentro da class
		$this->run($this->getUrl());
	}
	// Método que retorna o valor contido no atributo routes
	public function getRoutes() {
		return $this->routes;
	}
	// Método que manipula o atributo routes atribuindo a ele a rota digitada no browser
	public function setRoutes(array $routes) {
		$this->routes = $routes;
	}
	// Método que retorna os dados da rota digitada no browser instanciando a class a ser executada apontando para a ação a ser tomada dentro da class que é o método dentro dela
	// Desta forma é interligada a rota com a class de controller responsavel por continuar o fluxo da execução
	protected function run($url) {
		// Laço que percorre todos array de rotas
		foreach ($this->getRoutes() as $key => $route) {
			// Condição que descobre os dados da rota digitado no browser
			if($url == $route['route']) {
				// Montando o caminho da class a ser instanciada
				$class = "App\\Controllers\\".ucfirst($route['controller']);
				// Instanciando a class
				$controller = new $class;
				// Recupera a action do array route que é o método da class
				$action = $route['action'];
				// Apontando a ação a ser tomada dentro da class que é o método a ser executado
				$controller->$action();
			}
		}
	}
	// Método que retorna a rota digitada no browser
	protected function getUrl() {
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}
}

?>