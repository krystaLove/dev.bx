<?php

namespace bitflix\core;

use bitflix\database\Database;

/**
 *	Application singleton, that includes main common objects for scripts to use
 */
class Application
{
	/** @var string /dev.bx/ */
	public static string $ROOT_DIR = "";

	public static Application $app;
	public Database $db;

	public Config $config;

	public string $layout = "main";

	public Router $router;
	public Request $request;
	public Response $response;
	public ?Controller $controller = null;

	public View $view;

	public ServiceContainer $serviceContainer;

	public function __construct(string $rootPath)
	{
		self::$ROOT_DIR = $rootPath;
		self::$app = $this;

		$this->config = new Config(self::$ROOT_DIR . "/bitflix/config");
		$this->db = new Database();

		$this->db->connect($this->config->get('database'));

		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router($this->request, $this->response);

		$this->view = new View();

		$this->serviceContainer = new ServiceContainer();
	}

	public function setController(Controller $controller): void
	{
		$this->controller = $controller;
	}

	public function run(): void
	{
		echo $this->router->handle();
	}
}