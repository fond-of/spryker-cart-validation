<?php

namespace FondOfSpryker\Zed\CartValidation\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CartValidation\Business\CartValidationFacade;
use Generated\Shared\Transfer\QuoteTransfer;

class ClearQuoteValidationMessagesPostReloadItemsPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CartValidation\Business\CartValidationFacade
     */
    protected $cartValidationFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CartValidation\Communication\Plugin\CartExtension\ClearQuoteItemValidationMessagesPostReloadItemsPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartValidationFacadeMock = $this->getMockBuilder(CartValidationFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ClearQuoteItemValidationMessagesPostReloadItemsPlugin();
        $this->plugin->setFacade($this->cartValidationFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostReloadItems(): void
    {
        $this->cartValidationFacadeMock->expects($this->atLeastOnce())
            ->method('clearQuoteValidationMessages')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->postReloadItems(
                $this->quoteTransferMock
            )
        );
    }
}
