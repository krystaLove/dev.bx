<?php
/** @var string $lastSearch */
?>
<form action="/search" method="get" class="header-content--search">
	<div class="header-content--search-bar">
		<div class="header-content--search-icon">
			<img src="public/img/search.svg" alt="search">
		</div>
		<label class="header-content--search-placeholder">
			<input type="text" name="v" placeholder="Поиск по каталогу..." value="<?= $lastSearch ?>">
		</label>
	</div>
	<input class="header-content--search-submit-btn btn-round btn-orange" type="submit" value="Искать">
</form>
