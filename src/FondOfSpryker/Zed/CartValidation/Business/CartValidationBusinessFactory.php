<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\CartValidation\Business;

use FondOfSpryker\Zed\CartValidation\Business\Model\CartItemValidationMessageCleaner;
use FondOfSpryker\Zed\CartValidation\Business\Model\CartItemValidationMessageCleanerInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CartValidation\Business\CartValidationFacadeInterface getFacade()
 */
class CartValidationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CartValidation\Business\Model\CartItemValidationMessageCleanerInterface
     */
    public function createCartItemValidationMessageCleaner(): CartItemValidationMessageCleanerInterface
    {
        return new CartItemValidationMessageCleaner();
    }
}
