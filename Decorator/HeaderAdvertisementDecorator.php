<?php

namespace Decorator;

use Entity\IAdvertisement;
use Service\Formatting\HtmlTextFormatter;

class HeaderAdvertisementDecorator extends BodyAdvertisementDecorator
{

	public function addBodyData(string $data): IAdvertisement
	{
		$formatter = new HtmlTextFormatter();
		return $this->setBody($formatter->format($data, "h1") . $this->getBody());
	}
}