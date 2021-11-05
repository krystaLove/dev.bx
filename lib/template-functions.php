<?php

function renderTemplate(string $path, array $templateData = []) : string
{
	if(!file_exists($path))
	{
		return '';
	}

	ob_start();

	extract($templateData, EXTR_OVERWRITE);

	include $path;

	return ob_get_clean();
}

function renderLayout(string $content, array $layoutData)
{
	$layoutData = array_merge($layoutData, ['content' => $content]);

	$layout = renderTemplate('./resources/pages/layout.php', $layoutData);
	echo $layout;
}
