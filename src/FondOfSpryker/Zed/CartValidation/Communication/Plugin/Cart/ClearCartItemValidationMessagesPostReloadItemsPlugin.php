<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\CartValidation\Communication\Plugin\Cart;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\PostReloadItemsPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CartValidation\Business\CartValidationFacadeInterface getFacade()
 */
class ClearCartItemValidationMessagesPostReloadItemsPlugin extends AbstractPlugin implements PostReloadItemsPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function postReloadItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFacade()->clearCartItemValidationMessages($quoteTransfer);
    }
}
