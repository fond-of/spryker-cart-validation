<?php

namespace FondOfSpryker\Zed\CartValidation\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CartValidation\Business\CartValidationFacade;
use Generated\Shared\Transfer\QuoteTransfer;

class ClearCartItemValidationMessagesPostReloadItemsPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CartValidation\Communication\Plugin\CartExtension\ClearCartItemValidationMessagesPostReloadItemsPlugin
     */
    protected $clearCartItemValidationMessagesPostReloadItemsPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CartValidation\Business\CartValidationFacade
     */
    protected $cartValidationFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

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

        $this->clearCartItemValidationMessagesPostReloadItemsPlugin = new ClearCartItemValidationMessagesPostReloadItemsPlugin();
        $this->clearCartItemValidationMessagesPostReloadItemsPlugin->setFacade($this->cartValidationFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostReloadItems(): void
    {
        $this->cartValidationFacadeMock->expects($this->atLeastOnce())
            ->method('clearQuoteItemValidationMessages')
            ->willReturn($this->quoteTransferMock);

        $this->assertInstanceOf(
            QuoteTransfer::class,
            $this->clearCartItemValidationMessagesPostReloadItemsPlugin->postReloadItems(
                $this->quoteTransferMock
            )
        );
    }
}
