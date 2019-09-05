<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\CartValidation\Business\Model;

use ArrayObject;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteItemValidationMessageCleaner implements QuoteItemValidationMessageCleanerInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function clearValidationMessages(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $this->clearValidationMessage($itemTransfer);
        }

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\ItemTransfer
     */
    protected function clearValidationMessage(ItemTransfer $itemTransfer): ItemTransfer
    {
        return $itemTransfer->setValidationMessages(new ArrayObject());
    }
}
