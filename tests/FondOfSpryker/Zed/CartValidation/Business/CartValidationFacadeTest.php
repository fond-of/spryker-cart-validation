<?php

namespace FondOfSpryker\Zed\CartValidation\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CartValidation\Business\Model\QuoteItemValidationMessageCleanerInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class CartValidationFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CartValidation\Business\CartValidationFacade
     */
    protected $cartValidationFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CartValidation\Business\CartValidationBusinessFactory
     */
    protected $cartValidationBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CartValidation\Business\Model\QuoteItemValidationMessageCleanerInterface
     */
    protected $quoteItemValidationMessageCleanerInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->cartValidationBusinessFactoryMock = $this->getMockBuilder(CartValidationBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteItemValidationMessageCleanerInterfaceMock = $this->getMockBuilder(QuoteItemValidationMessageCleanerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartValidationFacade = new CartValidationFacade();
        $this->cartValidationFacade->setFactory($this->cartValidationBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testClearQuoteItemValidationMessages(): void
    {
        $this->cartValidationBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCartItemValidationMessageCleaner')
            ->willReturn($this->quoteItemValidationMessageCleanerInterfaceMock);

        $this->quoteItemValidationMessageCleanerInterfaceMock->expects($this->atLeastOnce())
            ->method('clearValidationMessages')
            ->willReturn($this->quoteTransferMock);

        $this->assertInstanceOf(
            QuoteTransfer::class,
            $this->cartValidationFacade->clearQuoteItemValidationMessages($this->quoteTransferMock)
        );
    }
}
