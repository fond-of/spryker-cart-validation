<?php

namespace FondOfSpryker\Zed\CartValidation\Business\Model;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteItemValidationMessageCleanerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CartValidation\Business\Model\QuoteItemValidationMessageCleaner
     */
    protected $quoteItemValidationMessageCleaner;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var array
     */
    protected $itemTransferMocks;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->itemTransferMock,
        ];

        $this->quoteItemValidationMessageCleaner = new QuoteItemValidationMessageCleaner();
    }

    /**
     * @return void
     */
    public function testClearValidationMessages(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('setValidationMessages')
            ->willReturn($this->itemTransferMock);

        $this->assertInstanceOf(
            QuoteTransfer::class,
            $this->quoteItemValidationMessageCleaner->clearValidationMessages($this->quoteTransferMock)
        );
    }
}
