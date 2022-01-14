<?php

namespace bitflix\core;

class Controller
{
	public string $layout = 'main';
	public string $action = "";

	public function setLayout(string $layout)
	{
		$this->layout = $layout;
	}

	public function render(string $view, array $viewData = []): string
	{
		return Application::$app->view->renderView($view, $viewData);
	}
}