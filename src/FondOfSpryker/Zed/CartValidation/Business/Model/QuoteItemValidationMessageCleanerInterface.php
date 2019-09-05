<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CartValidation\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteItemValidationMessageCleanerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function clearValidationMessages(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
