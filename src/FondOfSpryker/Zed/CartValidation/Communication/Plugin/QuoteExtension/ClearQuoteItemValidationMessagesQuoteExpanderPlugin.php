<?php

namespace FondOfSpryker\Zed\CartValidation\Communication\Plugin\QuoteExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Zed\CartValidation\CartValidationConfig getConfig()
 * @method \FondOfSpryker\Zed\CartValidation\Business\CartValidationFacadeInterface getFacade()
 */
class ClearQuoteItemValidationMessagesQuoteExpanderPlugin extends AbstractPlugin implements QuoteExpanderPluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFacade()->clearQuoteItemValidationMessages($quoteTransfer);
    }
}
