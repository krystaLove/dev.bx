<?php

namespace bitflix\controllers;

use bitflix\core\Application;
use bitflix\core\Controller;
use bitflix\core\Request;
use bitflix\core\Response;
use bitflix\models\services\MovieService;

class SiteController extends Controller
{
	private MovieService $movieService;

	private array $errors = [];

	public function __construct()
	{
		$this->movieService = Application::$app->serviceContainer->get('movie');
	}

	public function index(): string
	{
		return $this->render('index', $this->formCommonData('/', true));
	}

	public function genre(Request $request, Response $response): string
	{
		$data = $this->formCommonData();
		$requestData = $request->getData();

		if(isset($requestData['v']))
		{
			$data['movies'] = $this->movieService->getAll($data['genres'], $requestData['v']);
			$data['currentPage'] = $requestData['v'];
		}
		else
		{
			$response->redirect("/");
		}

		return $this->render('index', $data);
	}

	public function movie(Request $request, Response $response): string
	{
		$data = $this->formCommonData();

		$movieId = $request->getData()['id'];

		if(isset($movieId))
		{
			$data['movie'] = $this->movieService->getById((int) $movieId);
		}
		else
		{
			$response->redirect("/");
		}

		return $this->render('detail-movie', $data);
	}

	public function search(Request $request, Response $response): string
	{
		$data = $this->formCommonData();

		$movieSearch = $request->getData()['v'];

		if(isset($movieSearch) && !empty($movieSearch))
		{
			$data['movies'] = $this->movieService->getMoviesBySubstr($data['genres'], $movieSearch);
			$data['lastSearch'] = $movieSearch;
		}
		else
		{
			$response->redirect("/");
		}


		return $this->render('index', $data);
	}

	public function favorite(): string
	{
		return $this->render('favorite', $this->formCommonData('favorite', true));
	}

	public function movieAdd(): string
	{
		return $this->render('add-movie', $this->formCommonData('add-movie', true));
	}


	private function formCommonData($currentPage = '/', bool $addAllMovies = false): array
	{
		$data = [
			'config' => Application::$app->config->get('app'),
			'genres' => $this->movieService->getAllGenres(),
			'lastSearch' => '',
			'currentPage' => $currentPage
		];

		if($addAllMovies)
		{
			$data['movies'] = $this->movieService->getAll($data['genres']);
		}

		return $data;
	}
}