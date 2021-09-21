<?php

namespace FondOfSpryker\Zed\CartValidation\Business;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearerInterface;

class CartValidationFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CartValidation\Business\CartValidationBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearerInterface
     */
    protected $quoteValidationMessageClearerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteItemValidationMessageClearerInterface
     */
    protected $quoteItemValidationMessageClearerMock;

    /**
     * @var \FondOfSpryker\Zed\CartValidation\Business\CartValidationFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CartValidationBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteItemValidationMessageClearerMock = $this->getMockBuilder(QuoteItemValidationMessageClearerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CartValidationFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testClearQuoteValidationMessages(): void
    {
        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createQuoteValidationMessageCleaner')
            ->willReturn($this->quoteValidationMessageClearerMock);

        $this->quoteValidationMessageClearerMock->expects($this->atLeastOnce())
            ->method('clear')
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->clearQuoteValidationMessages($this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testClearQuoteItemValidationMessages(): void
    {
        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createQuoteItemValidationMessageCleaner')
            ->willReturn($this->quoteItemValidationMessageClearerMock);

        $this->quoteItemValidationMessageClearerMock->expects($this->atLeastOnce())
            ->method('clear')
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->clearQuoteItemValidationMessages($this->quoteTransferMock)
        );
    }
}
