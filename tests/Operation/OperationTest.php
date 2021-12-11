<?php

use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
	protected function getOrderThatSavesSuccessfully()
	{
		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock()
		;

		$order->expects(static::once())
			->method('save')
			->willReturn(new \App\Result())
		;

		return $order;
	}

	protected function getOrderThatIsNeverUsed()
	{
		$order = $this->getMockBuilder(\App\Order::class)
					  ->onlyMethods(['save'])
					  ->getMock()
		;

		$order->expects(static::never())
			  ->method('save')
		;

		return $order;
	}

	protected function getActionThatProcessSuccessfully()
	{
		$action = $this->getMockBuilder(\App\Operation\Action::class)
					   ->onlyMethods(['process'])
					   ->getMockForAbstractClass()
		;
		$action->expects(static::once())
			   ->method('process')
			   ->willReturn(new \App\Result())
		;

		return $action;
	}

	protected function getActionThatNeverInvoked()
	{
		$action = $this->getMockBuilder(\App\Operation\Action::class)
			->onlyMethods(['process'])
			->getMockForAbstractClass()
		;
		$action->expects(static::never())
			->method('process')
		;

		return $action;
	}

	public function testThatLaunchSuccessIfOrderSaveSuccess(): void
	{
		$order = $this->getOrderThatSavesSuccessfully();

		$operation = new App\Operation\Operation($order);

		$result = $operation->launch();

		static::assertTrue($result->isSuccess());
	}

	public function testThatLaunchFailIfOrderSaveFail(): void
	{
		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock()
		;

		$errorCode = random_int(0, 999);

		$result = new \App\Result();
		$result->addError(new Error('Test message', $errorCode));

		$order->expects(static::once())
			->method('save')
			->willReturn($result)
		;

		$operation = new App\Operation\Operation($order);

		$result = $operation->launch();

		static::assertFalse($result->isSuccess());

		$errorWithCode = null;
		foreach ($result->getErrors() as $error)
		{
			if ($error->getCode() === $errorCode)
			{
				$errorWithCode = $error;
			}
		}

		static::assertNotNull($errorWithCode);
	}

	public function testThatOrderSaveIsNotInvokedIfBeforeActionFail(): void
	{
		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock()
		;

		$order->expects(static::never())
			->method('save')
		;

		$operation = new App\Operation\Operation($order);

		$action = $this->getMockBuilder(\App\Operation\Action::class)
			->onlyMethods(['process'])
			->getMockForAbstractClass()
		;
		$errorMessage = 'Error during before action in test';
		$action->expects(static::once())
			->method('process')
			->with($order)
			->willReturn((new \App\Result())->addError(new Error($errorMessage)))
		;

		$operation->addAction(
			\App\Operation\Operation::ACTION_BEFORE_SAVE,
			$action
		);

//		$action = new class extends \App\Operation\Action {
//			public function process(\App\Order $order): \App\Result
//			{
//				return (new \App\Result())->addError(new Error('Test error'));
//			}
//		};

		$afterAction = $this->getActionThatNeverInvoked();

		$operation->addAction(
			\App\Operation\Operation::ACTION_AFTER_SAVE,
			$afterAction
		);

		$result = $operation->launch();

		static::assertFalse($result->isSuccess());
		static::assertEquals($errorMessage, $result->getErrorMessages()[0]);
	}

	public function testThatOperationConfigurationIsPossible(): void
	{
		$settings = new App\Operation\Settings();

		$order = $this->getOrderThatSavesSuccessfully();

		$operation = new App\Operation\Operation($order, $settings);

		$result = $operation->launch();

		static::assertNotNull($result);
	}

	public function testThatOperationHasSettingsObject(): void
	{
		$settings = new App\Operation\Settings();

		$order = $this->getMockBuilder(\App\Order::class)
			->onlyMethods(['save'])
			->getMock()
		;

		$operation = new App\Operation\Operation($order, $settings);

		static::assertObjectHasAttribute('settings', $operation);
	}

	public function testThatOperationDoesNotInvokeBeforeActionsIfTheyDisabledInSettings(): void
	{
		$settings = new App\Operation\Settings();

		$settings->disableBeforeSaveActions();

		$order = $this->getOrderThatSavesSuccessfully();

		$operation = new App\Operation\Operation($order, $settings);
		$operation->addAction(
			App\Operation\Operation::ACTION_BEFORE_SAVE,
			$this->getActionThatNeverInvoked()
		);

		$operation->launch();
	}

	public function testThatOperationDoesNotInvokeAfterActionsIfTheyDisabledInSettings(): void
	{
		$settings = new App\Operation\Settings();

		$settings->disableAfterSaveActions();

		$order = $this->getOrderThatSavesSuccessfully();

		$operation = new App\Operation\Operation($order, $settings);
		$operation->addAction(
			App\Operation\Operation::ACTION_AFTER_SAVE,
			$this->getActionThatNeverInvoked()
		);

		$operation->launch();
	}

	public function testThatOperationsInvokeIfSettingsIsDefault(): void
	{
		$order = $this->getOrderThatSavesSuccessfully();

		$operation = new App\Operation\Operation($order, null);

		$operation
			->addAction(
			App\Operation\Operation::ACTION_BEFORE_SAVE,
				$this->getActionThatProcessSuccessfully())
			->addAction(
			App\Operation\Operation::ACTION_AFTER_SAVE,
				$this->getActionThatProcessSuccessfully())
		;

		$operation->launch();
	}

	public function testThatAddActionThrowExceptionIfActionPlacementIsNotValid(): void
	{
		$order = $this->getOrderThatIsNeverUsed();

		$operation = new App\Operation\Operation($order, null);

		$this->expectException(Exception::class);

		$operation->addAction("", $this->getActionThatNeverInvoked());
	}

	public function testThatLaunchFailIfAfterSaveActionFail(): void
	{
		$order = $this->getOrderThatSavesSuccessfully();

		$settings = new \App\Operation\Settings();

		$operation = new App\Operation\Operation($order, $settings);

		$action = $this->getMockBuilder(\App\Operation\Action::class)
					   ->onlyMethods(['process'])
					   ->getMockForAbstractClass()
		;
		$action->expects(static::once())
			   ->method('process')
			   ->willReturn((new \App\Result())->addError(new Error("Error processing")));

		$operation
			->addAction(App\Operation\Operation::ACTION_AFTER_SAVE, $action);
		;

		$result = $operation->launch();

		self::assertFalse($result->isSuccess());
	}
}
