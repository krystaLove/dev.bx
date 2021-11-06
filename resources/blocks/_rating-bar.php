<?php
/** @var int $rating */
?>

<div class="detail-movie-card--body-right--rating-bar">
	<?php for ($i = 1; $i <= 10; $i++): ?>
		<div class="rating-bar-element  <?= $i <= $rating ? "rating-bar-element--filled" : "" ?> "></div>
	<?php endfor; ?>
</div>