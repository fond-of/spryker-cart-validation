<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\CartValidation\Business;

use FondOfSpryker\Zed\CartValidation\Business\Model\QuoteItemValidationMessageCleaner;
use FondOfSpryker\Zed\CartValidation\Business\Model\QuoteItemValidationMessageCleanerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CartValidation\Business\CartValidationFacadeInterface getFacade()
 */
class CartValidationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CartValidation\Business\Model\QuoteItemValidationMessageCleanerInterface
     */
    public function createCartItemValidationMessageCleaner(): QuoteItemValidationMessageCleanerInterface
    {
        return new QuoteItemValidationMessageCleaner();
    }
}
