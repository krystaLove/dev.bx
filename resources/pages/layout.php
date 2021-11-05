<?php
/** @var string $content */
/** @var array $genres */
/** @var array $config */
/** @var string $currentPage */
/** @var string $lastSearch */
require_once "./lib/template-functions.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?= $config['title'] ?></title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./resources/css/reset.css">
	<link rel="stylesheet" href="./resources/css/style.css">
</head>
<body>
	<div class="wrapper">
		<div class="sidebar">
			<a class="logo" href="index.php">
				<img src="./resources/img/logo.svg" alt="<?= $config['title'] ?>">
			</a>
			<ul class="menu">
				<li class="menu-item <?= $currentPage == 'index' ? "menu-item--active" : "" ?>">
					<a href="index.php"><?= $config['menu']['index'] ?></a>
				</li>
				<?php foreach ($genres as $genreCode => $genreValue): ?>
					<li class="menu-item <?= $currentPage == ('index' . '?' . $genreCode) ? "menu-item--active" : "" ?> ">
						<a href="index.php?genre=<?= $genreCode ?>"><?= $genreValue ?></a>
					</li>
				<?php endforeach; ?>
				<li class="menu-item <?= $currentPage == 'favorite' ? "menu-item--active" : "" ?>">
					<a href="favorite.php"><?= $config['menu']['favorite'] ?></a>
				</li>
			</ul>
		</div>
		<div class="container">
			<div class="header">
				<div class="header-content">
					<?= renderTemplate('./resources/blocks/_search-bar.php', ['lastSearch' => $lastSearch]); ?>
					<div class="header-content--add-film-btn btn-round btn-green">
						<a href="add-movie.php">Добавить фильм</a>
					</div>
				</div>
			</div>
			<div class="content"><?= $content ?></div>
		</div>
	</div>

</body>
</html>
