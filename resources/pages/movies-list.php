<?php
require_once "./lib/template-functions.php"
/** @var array|null $movies */
/** @var array $config */
/** @var array|null $errors */
?>

<?php if(empty($errors)): ?>

<div class="movie-list">
	<?php if(empty($movies)):?>
		<div style="font-family:Open Sans, sans-serif; font-size: 25px; margin-top: 30px">
			По данному запросу не было найдено ни одного фильма.
		</div>
	<?php endif ?>
	<?php foreach ($movies as $movie): ?>
		<?= renderTemplate("./resources/blocks/_movie-card.php", ["movie" => $movie, "config" => $config]); ?>
	<?php endforeach; ?>
</div>

<?php else: ?>

<?php foreach ($errors as $error): ?>
	<div><?= $error ?></div>
<?php endforeach; ?>

<?php endif; ?>
