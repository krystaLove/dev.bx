<?php
declare(strict_types=1);

use bitflix\controllers\SiteController;
use bitflix\core\Application;
use bitflix\models\repositories\MysqlMovieRepository;
use bitflix\models\services\MovieService;

require_once "../vendor/autoload.php";

error_reporting(E_ALL);

$app = new Application(dirname(__DIR__));

$app->router->get('/', 	 [SiteController::class, 'index']);
$app->router->get('/genre', [SiteController::class, 'genre']);
$app->router->get('/movie', [SiteController::class, 'movie']);
$app->router->get('/search', [SiteController::class, 'search']);
$app->router->get('/favorite', [SiteController::class, 'favorite']);
$app->router->get('/movie-add', [SiteController::class, 'movieAdd']);

$app->serviceContainer->add('movie', MovieService::class, [new MysqlMovieRepository()]);

$app->run();