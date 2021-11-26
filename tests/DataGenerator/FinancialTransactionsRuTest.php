<?php

use App\DataGenerator\FinancialTransactionsRu;
use PHPUnit\Framework\TestCase;

class FinancialTransactionsRuTest extends TestCase
{
	public function getValidateFailSamples() : array
	{
		return [
			'empty' => [
				[],
			],
			'filled but empty' => [
				[
					'Name' => '',
					'PersonalAcc' => '',
					'BankName' => '',
					'BIC' => '',
					'CorrespAcc' => ''
				]
			]
		];
	}

	/**
	 * @dataProvider getValidateFailSamples
	 *
	 * @param array $fields
	 */
	public function testValidateFail(array $fields) : void
	{
		$dataGenerator = new FinancialTransactionsRu();
		$dataGenerator->setFields($fields);

		$result = $dataGenerator->validate();

		static::assertFalse($result->isSuccess());
	}

	public function testThatValidateSuccess() : void
	{
		$dataGenerator = new FinancialTransactionsRu();
		$dataGenerator
			->setName('Name')
			->setBIC('BIC')
			->setBankName('BankName')
			->setCorrespondentAccount('CorrespondentAccount')
			->setPersonalAccount('PersonalAcc');

		$result = $dataGenerator->validate();
		static::assertTrue($result->isSuccess());
	}

}