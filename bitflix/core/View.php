<?php

namespace bitflix\core;

class View
{
	public string $title = '';

	public function renderView(string $viewName, array $data = []): string
	{
		$layoutName = Application::$app->controller->layout ?? Application::$app->layout;

		$viewContent = self::renderTemplate(
			Application::$ROOT_DIR . "/bitflix/views/$viewName.php", $data);

		$data = array_merge($data, ['content' => $viewContent]);
		return self::renderTemplate(
			Application::$ROOT_DIR . "/bitflix/views/layouts/$layoutName.php", $data);
	}

	public static function renderTemplate(string $path, array $templateData = []) : string
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

}