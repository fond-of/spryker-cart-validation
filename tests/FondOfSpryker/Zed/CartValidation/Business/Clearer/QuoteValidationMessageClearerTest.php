<?php

namespace FondOfSpryker\Zed\CartValidation\Business\Clearer;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteValidationMessageClearerTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CartValidation\Business\Clearer\QuoteValidationMessageClearer
     */
    protected $quoteItemValidationMessageClearer;

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

        $this->quoteItemValidationMessageClearer = new QuoteValidationMessageClearer();
    }

    /**
     * @return void
     */
    public function testClearValidationMessages(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setValidationMessages')
            ->with(
                static::callback(
                    static function (ArrayObject $validationMessages) {
                        return $validationMessages->count() === 0;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteItemValidationMessageClearer->clear($this->quoteTransferMock)
        );
    }
}
