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
			],
			'filled but mistyped' => [
				[
					'Name' => [32131],
					'PersonalAcc' => 'asdad',
					'BankName' => 'asdasd',
					'BIC' => 'asdsad',
					'CorrespAcc' => 'adasdsad'
				]
			],
			'filled but length is long' => [
				[
					'Name' => str_repeat('a', 161),
					'PersonalAcc' => str_repeat('a', 21),
					'BankName' => str_repeat('a', 46),
					'BIC' => str_repeat('a', 9),
					'CorrespAcc' => str_repeat('a', 21)
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

	public function testGetData() : FinancialTransactionsRu
	{
		$dataGenerator = new FinancialTransactionsRu();
		$dataGenerator
			->setName('Name')
			->setBIC('BIC')
			->setBankName('BankName')
			->setCorrespondentAccount('CorrespondentAccount')
			->setPersonalAccount('PersonalAcc');

		$toCheck = "ST00012|Name=Name|PersonalAcc=PersonalAcc|BankName=BankName|BIC=BIC|CorrespAcc=CorrespondentAccount";
		static::assertEquals($toCheck, $dataGenerator->getData());

		return $dataGenerator;
	}

	/**
	 * @depends testGetData
	 */
	public function testAddFields($dataGenerator) : void
	{
		$dataGenerator->addFields(['test'=> 1, 'test2' => 2]);

		static::assertStringContainsString("test=1|test2=2", $dataGenerator->getData());
	}

	/**
	 * @depends testGetData
	 */
	public function testSetField($dataGenerator) : void
	{
		$dataGenerator->setField('test3', 3);

		static::assertStringContainsString("test3=3", $dataGenerator->getData());
	}

}