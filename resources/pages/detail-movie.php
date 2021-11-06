<?php
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";
/** @var array|null $movie */
?>

<div class="detail-movie-card">
	<div class="detail-movie-card--head">
		<div class="detail-movie-card--head-up">
			<div class="detail-movie-card--head-title"><?= $movie['title'] ?></div>
			<div class="detail-movie-card--head-favorite-btn">
				<img src="./resources/img/heart.svg" alt="Add to favorite">
			</div>
		</div>
		<div class="detail-movie-card--head-down">
			<div class="detail-movie-card--head-subtitle"><?= $movie['original-title'] ?></div>
			<div class="detail-movie-card--head-age-rating"><?= $movie['age-restriction'] ?>+</div>
		</div>
	</div>
	<div class="detail-movie-card--body">
		<div class="detail-movie-card--body-left">
			<div class="detail-movie-card--body-image">
				<img src="<?= getMovieImagePath($movie)?>" alt="preview">
			</div>
		</div>
		<div class="detail-movie-card--body-right">
			<div class="detail-movie-card--body-right--rating">
				<?= renderTemplate("./resources/blocks/_rating-bar.php", ['rating' => $movie['rating']]) ?>
				<div class="detail-movie-card--body-right--rating-score"><a><?= $movie['rating'] ?></a></div>
			</div>
			<div class="detail-movie-card--body-right--about-movie-wrapper">
				<h1>О фильме</h1>
				<div class="about-movie-wrapper--year-wrapper">
					<h2>Год производства: </h2>
					<a><?= $movie['release-date'] ?></a>
				</div>
				<div class="about-movie-wrapper--producer-wrapper">
					<h2>Режиссёр: </h2>
					<a><?= $movie['director'] ?></a>
				</div>
				<div class="about-movie-wrapper--actors-wrapper">
					<h2>В главных ролях: </h2>
					<a><?= implode(', ', $movie['cast']) ?></a>
				</div>
			</div>
			<div class="detail-movie-card--body-right--description-wrapper">
				<h1>Описание</h1>
				<div class="detail-movie-card--body-right--description">
					<?= $movie['description'] ?>
				</div>
			</div>
		</div>
	</div>
</div>
