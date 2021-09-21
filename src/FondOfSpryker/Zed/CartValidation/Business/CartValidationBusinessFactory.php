<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CartValidation\Business;

use FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearer;
use FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearerInterface;
use FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearer;
use FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CartValidationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearerInterface
     */
    public function createQuoteValidationMessageClearer(): QuoteValidationMessageClearerInterface
    {
        return new QuoteValidationMessageClearer();
    }

    /**
     * @return \FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearerInterface
     */
    public function createQuoteItemValidationMessageClearer(): QuoteItemValidationMessageClearerInterface
    {
        return new QuoteItemValidationMessageClearer();
    }
}
