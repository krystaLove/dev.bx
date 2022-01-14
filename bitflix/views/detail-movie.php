<?php

/** @var Movie $movie */

use bitflix\core\Application;
use bitflix\core\View;
use bitflix\models\entities\Movie;

?>

<?php if (!$movie): ?>
<div>404 Error</div>
<?php else: ?>
<div class="detail-movie-card">
	<div class="detail-movie-card--head">
		<div class="detail-movie-card--head-up">
			<div class="detail-movie-card--head-title"><?= $movie->getTitle() ?></div>
			<div class="detail-movie-card--head-favorite-btn">
				<img src="public/img/heart.svg" alt="Add to favorite">
			</div>
		</div>
		<div class="detail-movie-card--head-down">
			<div class="detail-movie-card--head-subtitle"><?= $movie->getOriginalTitle() ?></div>
			<div class="detail-movie-card--head-age-rating"><?= $movie->getAgeRestriction() ?>+</div>
		</div>
	</div>
	<div class="detail-movie-card--body">
		<div class="detail-movie-card--body-left">
			<div class="detail-movie-card--body-image">
				<img src="<?= $movie->getImagePath()?>" alt="preview">
			</div>
		</div>
		<div class="detail-movie-card--body-right">
			<div class="detail-movie-card--body-right--rating">
				<?= View::renderTemplate(Application::$ROOT_DIR . "/bitflix/views/blocks/_rating-bar.php", ['rating' => $movie->getRating()]) ?>
				<div class="detail-movie-card--body-right--rating-score"><a><?= $movie->getRating() ?></a></div>
			</div>
			<div class="detail-movie-card--body-right--about-movie-wrapper">
				<h1>О фильме</h1>
				<div class="about-movie-wrapper--year-wrapper">
					<h2>Год производства: </h2>
					<a><?= $movie->getReleaseDate() ?></a>
				</div>
				<div class="about-movie-wrapper--producer-wrapper">
					<h2>Режиссёр: </h2>
					<a><?= $movie->getDirector(); ?></a>
				</div>
				<div class="about-movie-wrapper--actors-wrapper">
					<h2>В главных ролях: </h2>
					<a><?= implode(', ', $movie->getActors()) ?></a>
				</div>
			</div>
			<div class="detail-movie-card--body-right--description-wrapper">
				<h1>Описание</h1>
				<div class="detail-movie-card--body-right--description">
					<?= $movie->getDescription() ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endif ?>