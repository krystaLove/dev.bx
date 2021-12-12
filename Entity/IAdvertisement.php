<?php

namespace Entity;

interface IAdvertisement
{
	public function getTitle(): string;
	public function setTitle(string $title): IAdvertisement;
	public function getBody(): string;
	public function setBody(string $body): IAdvertisement;
	public function getDuration(): int;
	public function setDuration(int $duration): IAdvertisement;
}