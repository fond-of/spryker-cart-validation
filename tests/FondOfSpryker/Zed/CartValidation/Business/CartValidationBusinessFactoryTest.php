<?php

namespace FondOfSpryker\Zed\CartValidation\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CartValidation\Business\Model\QuoteItemValidationMessageCleanerInterface;

class CartValidationBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CartValidation\Business\CartValidationBusinessFactory
     */
    protected $cartValidationBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartValidationBusinessFactory = new CartValidationBusinessFactory();
    }

    /**
     * @return void
     */
    public function testCreateCartItemValidationMessageCleaner(): void
    {
        $this->assertInstanceOf(
            QuoteItemValidationMessageCleanerInterface::class,
            $this->cartValidationBusinessFactory->createCartItemValidationMessageCleaner()
        );
    }
}
