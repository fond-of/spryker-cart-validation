<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CartValidation\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CartValidation\Business\CartValidationBusinessFactory getFactory()
 */
class CartValidationFacade extends AbstractFacade implements CartValidationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function clearQuoteItemValidationMessages(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()
            ->createCartItemValidationMessageCleaner()
            ->clearValidationMessages($quoteTransfer);
    }
}
