<?php
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";
/** @var array $movie */
/** @var array $config */
?>

<div class="movie-list--item">
	<div class="movie-list--item-hover">
		<div class="movie-list--item-detail-btn btn-round btn-green">
			<a href="detail-movie.php?movie-id= <?= $movie['id'] ?>">Подробнее</a>
		</div>
	</div>
	<div class="movie-list--item-image">
		<img src="<?=getMovieImagePath($movie)?>" alt="<?= $movie['title']?>">
	</div>
	<div class="movie-list--item-head">
		<div class="movie-list--item-title"><?= $movie['title']?></div>
		<div class="movie-list--item-subtitle"><?= $movie['original-title']?></div>
	</div>
	<div class="movie-list--item-wrapper">
		<div class="movie-list--item-description"><?= cutString($movie['description'], $config['card-description-length']) ?></div>
		<div class="movie-list--item-bottom">
			<div class="movie-list--item-clock">
				<img src="./resources/img/clock.svg" alt="clock">
			</div>
			<div class="movie-list--item-time"><?= $movie['duration'] ?> мин. / <?= formDurationInHoursOfMovie($movie) ?></div>
			<div class="movie-list--item-info">
				<?= formAttrOfMovie($movie, 'genres') ?>
			</div>
		</div>
	</div>
</div>
