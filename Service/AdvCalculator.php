<?php

namespace Service;

use Entity\IAdvertisement;

class AdvCalculator implements Calculator
{
	private float $totalCost;
	private IAdvertisement $advertisement;

	/**
	 * @param IAdvertisement $advertisement
	 */
	public function __construct(IAdvertisement $advertisement)
	{
		$this->advertisement = $advertisement;
	}

	public function applyCost(): Calculator
	{
		$this->totalCost = $this->advertisement->getDuration() * 100;

		return $this;
	}

	public function getTotalCost(): float
	{
		return $this->totalCost;
	}
}