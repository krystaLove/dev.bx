<?php

class AvitoAdvertisement
{
	private string $title;
	private string $body;

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): AvitoAdvertisement
	{
		$this->title = $title;
		return $this;
	}

	public function getBody(): string
	{
		return $this->body;
	}

	public function setBody(string $body): AvitoAdvertisement
	{
		$this->body = $body;
		return $this;
	}

}