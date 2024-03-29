<?php

namespace FondOfSpryker\Zed\CartValidation\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearer;
use FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearer;

class CartValidationBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CartValidation\Business\CartValidationBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactory = new CartValidationBusinessFactory();
    }

    /**
     * @return void
     */
    public function testCreateQuoteValidationMessageClearer(): void
    {
        $this->assertInstanceOf(
            QuoteValidationMessageClearer::class,
            $this->businessFactory->createQuoteValidationMessageClearer()
        );
    }

    /**
     * @return void
     */
    public function testCreateQuoteItemValidationMessageClearer(): void
    {
        $this->assertInstanceOf(
            QuoteItemValidationMessageClearer::class,
            $this->businessFactory->createQuoteItemValidationMessageClearer()
        );
    }
}
