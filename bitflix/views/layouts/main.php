<?php

/** @var string $content */
/** @var array $genres */
/** @var array $config */
/** @var string $currentPage */
/** @var string $lastSearch */

use bitflix\core\Application;
use bitflix\core\View;

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?= $config['title'] ?></title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="public/css/reset.css">
	<link rel="stylesheet" href="public/css/style.css">
</head>
<body>
	<div class="wrapper">
		<div class="sidebar">
			<a class="logo" href="/">
				<img src="public/img/logo.svg" alt="<?= $config['title'] ?>">
			</a>
			<ul class="menu">
				<li class="menu-item <?= $currentPage === '/' ? "menu-item--active" : "" ?>">
					<a href="/"><?= $config['menu']['index'] ?></a>
				</li>
				<?php foreach ($genres as $genre): ?>
					<li class="menu-item <?= $currentPage === $genre['CODE'] ? "menu-item--active" : "" ?> ">
						<a href="/genre?v=<?= $genre['CODE'] ?>"><?= $genre['NAME'] ?></a>
					</li>
				<?php endforeach; ?>
				<li class="menu-item <?= $currentPage === 'favorite' ? "menu-item--active" : "" ?>">
					<a href="/favorite"><?= $config['menu']['favorite'] ?></a>
				</li>
			</ul>
		</div>
		<div class="container">
			<div class="header">
				<div class="header-content">
					<?= View::renderTemplate(Application::$ROOT_DIR . './bitflix/views/blocks/_search-bar.php', ['lastSearch' => $lastSearch]); ?>
					<div class="header-content--add-film-btn btn-round btn-green">
						<a href="/add-movie">Добавить фильм</a>
					</div>
				</div>
			</div>
			<div class="content"><?= $content ?></div>
		</div>
	</div>

</body>
</html>
