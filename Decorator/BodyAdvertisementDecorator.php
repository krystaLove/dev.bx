<?php

namespace Decorator;

use Entity\IAdvertisement;

abstract class BodyAdvertisementDecorator implements IAdvertisement
{
	protected IAdvertisement $advertisement;

	public function __construct(IAdvertisement $advertisement)
	{
		$this->advertisement = $advertisement;
	}

	public function getTitle(): string
	{
		return $this->advertisement->getTitle();
	}

	public function setTitle(string $title): IAdvertisement
	{
		return $this->advertisement->setTitle($title);
	}

	public function getBody(): string
	{
		return $this->advertisement->getBody();
	}

	public function setBody(string $body): IAdvertisement
	{
		return $this->advertisement->setBody($body);
	}

	public function getDuration(): int
	{
		return $this->advertisement->getDuration();
	}

	public function setDuration(int $duration): IAdvertisement
	{
		return $this->advertisement->setDuration($duration);
	}

	abstract public function addBodyData(string $data): IAdvertisement;
}