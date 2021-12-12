<?php

namespace External;

class AvitoAdvertisementResult
{
	public string $targetingName;

	public function getTargetingName(): string
	{
		return $this->targetingName;
	}

	public function setTargetingName(string $targetingName): AvitoAdvertisementResult
	{
		$this->targetingName = $targetingName;
		return $this;
	}

}