<?php

namespace bitflix\core;

class Router
{
	public Request $request;
	public Response $response;

	protected array $routeMap = [];

	/**
	 * @param Request $request
	 * @param Response $response
	 */
	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}

	public function get(string $path, $callback): void
	{
		$this->routeMap['get'][$path] = $callback;
	}

	public function handle()
	{
		$path = $this->request->getPath();
		$method = $this->request->getMethod();

		$callback = $this->routeMap[$method][$path] ?? false;

		if($callback === false)
		{
			$this->response->setStatusCode(404);
			echo "Not found";
			exit;
		}

		if(is_string($callback))
		{
			return $this->renderView($callback);
		}

		if(is_array($callback))
		{
			/**
			 * @var Controller $controller
			 */
			$controller = new $callback[0];
			$controller->action = $callback[1];

			Application::$app->setController($controller);

			$callback[0] = $controller;
		}

		return $callback($this->request, $this->response);
	}

	public function renderView(string $view): string
	{
		return Application::$app->view->renderView($view);
	}
}