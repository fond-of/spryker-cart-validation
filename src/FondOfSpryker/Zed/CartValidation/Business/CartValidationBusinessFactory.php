<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CartValidation\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearer;
use Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearerInterface;
use Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearer;
use Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearerInterface;

class CartValidationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearerInterface
     */
    public function createQuoteValidationMessageClearer(): QuoteValidationMessageClearerInterface
    {
        return new QuoteValidationMessageClearer();
    }

    /**
     * @return \Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearerInterface
     */
    public function createQuoteItemValidationMessageClearer(): QuoteItemValidationMessageClearerInterface
    {
        return new QuoteItemValidationMessageClearer();
    }
}
