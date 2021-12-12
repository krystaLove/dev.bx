<?php

namespace Decorator;

use Entity\IAdvertisement;
use Service\Formatting\HtmlTextFormatter;

class FooterAdvertisementDecorator extends BodyAdvertisementDecorator
{

	public function addBodyData(string $data): IAdvertisement
	{
		$formatter = new HtmlTextFormatter();
		return $this->setBody($this->getBody() . $formatter->format($data, "h6"));
	}
}