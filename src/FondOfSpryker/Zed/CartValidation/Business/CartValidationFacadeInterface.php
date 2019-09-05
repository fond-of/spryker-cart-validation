<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\CartValidation\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface CartValidationFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function clearQuoteItemValidationMessages(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
