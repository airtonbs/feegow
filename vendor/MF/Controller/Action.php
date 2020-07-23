<?php

namespace MF\Controller;
// Class que contém métodos globais para funcionar qualquer class controller
abstract class Action {
	// Objeto contendo o conteúdo a ser utilizado dentro das páginas renderizadas
	protected $view;
	// Método mágico sendo executado quando a class IndexController for instânciada.
	// Recupera o atributo view e estância a class de forma automática
	public function __construct() {
		// Class stdClass nativa php. Permite criar objetos padrões, ouseja, vazios que dinamicamente podem ser compostos de atributos durante a lógia do processamento
		$this->view = new \stdClass;
	}
	// Método que renderiza as views
	// Esse método recebe o conteúdo e a página que irá conter o conteúdo, podendo assim ser alterado facilmente o layout da página a ser renderizada. Ex: Fundos diferentes para cada época do ano, Natal, Ano Novo etc...
	protected function render($view, $layout) {
		$this->view->page = $view;
		// Página padrão que abre todo conteúde a ser enviado para o browser, localizada dentro do diretório Views
		require_once 'App/Views/'.$layout.'.phtml';
	}
	// Nota Importante: O nome das class criadas dentro do diretório Controller, deverão conter no início do nome o nome do diretório dentro do diretório Views que irá controlar e a string Controller no final do nome
	// Exemplo: indexController -> Index nome do diretório dentro de Views e Controller -> string Controller no final do nome
	// Nota Importante: Os diretórios dentro do diretório Views, deverão ser criados com o nome todo em caixa baixa(minusculo)
	protected function content() {
		// Recupera o nome da classe do método
		$classAtual = get_class($this);
		// Retira a string de dentro do conteúdo da variável
		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);
		// Retirando a string Controller do nome da class de dentro da variável e colocando a palavra inteira em minusculo
		$classAtual = strtolower(str_replace('Controller', '', $classAtual));
		// Carregando o header da página atual
		require_once 'App/Views/header.phtml';
		// Carregando o conteúdo da página atual de dentro do diretório Views
		require_once 'App/Views/'.$classAtual.'/'.$this->view->page.'.phtml';
		// Carregando o footer(rodapé) da página atual
		require_once 'App/Views/footer.phtml';
	}
}

?>