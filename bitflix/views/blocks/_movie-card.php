<?php

/** @var Movie $movie */
/** @var array $config */

use bitflix\models\entities\Movie;

?>

<div class="movie-list--item">
	<div class="movie-list--item-hover">
		<div class="movie-list--item-detail-btn btn-round btn-green">
			<a href="/movie?id=<?= $movie->getId() ?>">Подробнее</a>
		</div>
	</div>
	<div class="movie-list--item-image">
		<img src="<?= $movie->getImagePath() ?>" alt="<?= $movie->getTitle()?>">
	</div>
	<div class="movie-list--item-head">
		<div class="movie-list--item-title"><?= $movie->getTitle()?></div>
		<div class="movie-list--item-subtitle"><?= $movie->getOriginalTitle()?></div>
	</div>
	<div class="movie-list--item-wrapper">
		<div class="movie-list--item-description"><?= $movie->getShortenDescription() ?></div>
		<div class="movie-list--item-bottom">
			<div class="movie-list--item-clock">
				<img src="/public/img/clock.svg" alt="clock">
			</div>
			<div class="movie-list--item-time"><?= $movie->getDuration() ?> мин. / <?= $movie->getDurationInHours() ?></div>
			<div class="movie-list--item-info">
				<?= implode(', ', $movie->getGenres()) ?>
			</div>
		</div>
	</div>
</div>
