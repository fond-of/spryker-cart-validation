<?php

namespace FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class QuoteValidationMessageTranslatorRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship\QuoteValidationMessageTranslatorRelationshipExpander
     */
    protected $quoteValidationMessageTranslatorRelationshipExpander;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    protected $glossaryStorageClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClientInterfaceMock;

    /**
     * @var array
     */
    protected $resources;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var \ArrayObject
     */
    protected $itemTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\MessageTransfer
     */
    protected $messageTransferMock;

    /**
     * @var \ArrayObject
     */
    protected $messageTransferMocks;

    /**
     * @var string
     */
    protected $translatedString;

    /**
     * @var string
     */
    protected $currentLocale;

    /**
     * @var array
     */
    protected $relationships;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestItemsAttributesTransfer
     */
    protected $restItemsAttributesTransferMock;

    /**
     * @var string
     */
    protected $messageValue;

    /**
     * @var array
     */
    protected $messageParameters;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientInterfaceMock = $this->getMockBuilder(GlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientInterfaceMock = $this->getMockBuilder(LocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResource::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resources = [
            $this->restResourceMock,
        ];

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = new ArrayObject([
            $this->itemTransferMock,
        ]);

        $this->messageTransferMock = $this->getMockBuilder(MessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messageTransferMocks = new ArrayObject([
            $this->messageTransferMock,
        ]);

        $this->messageValue = "message-value";

        $this->messageParameters = [];

        $this->currentLocale = "current-locale";

        $this->translatedString = "translated-string";

        $this->relationships = [
            'items' => $this->resources,
        ];

        $this->restItemsAttributesTransferMock = $this->getMockBuilder(RestItemsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidationMessageTranslatorRelationshipExpander = new QuoteValidationMessageTranslatorRelationshipExpander(
            $this->glossaryStorageClientInterfaceMock,
            $this->localeClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationships(): void
    {
        $this->restResourceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getValidationMessages')
            ->willReturn($this->messageTransferMocks);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('getValue')
            ->willReturn($this->messageValue);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('getParameters')
            ->willReturn($this->messageParameters);

        $this->localeClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->currentLocale);

        $this->glossaryStorageClientInterfaceMock->expects($this->atLeastOnce())
            ->method('translate')
            ->willReturn($this->translatedString);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('setValue')
            ->willReturn($this->messageTransferMock);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('setParameters')
            ->willReturn($this->messageTransferMock);

        $this->restResourceMock->expects($this->atLeastOnce())
            ->method('getRelationships')
            ->willReturn($this->relationships);

        $this->restResourceMock->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restItemsAttributesTransferMock);

        $this->restItemsAttributesTransferMock->expects($this->atLeastOnce())
            ->method('getValidationMessages')
            ->willReturn($this->messageTransferMocks);

        $this->assertIsArray(
            $this->quoteValidationMessageTranslatorRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsWrongResourceItems(): void
    {
        $this->restResourceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getValidationMessages')
            ->willReturn($this->messageTransferMocks);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('getValue')
            ->willReturn($this->messageValue);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('getParameters')
            ->willReturn($this->messageParameters);

        $this->localeClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->currentLocale);

        $this->glossaryStorageClientInterfaceMock->expects($this->atLeastOnce())
            ->method('translate')
            ->willReturn($this->translatedString);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('setValue')
            ->willReturn($this->messageTransferMock);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('setParameters')
            ->willReturn($this->messageTransferMock);

        $this->restResourceMock->expects($this->atLeastOnce())
            ->method('getRelationships')
            ->willReturn(['wrong-key']);

        $this->assertIsArray(
            $this->quoteValidationMessageTranslatorRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddResourceRelationshipsNoRestResource(): void
    {
        $this->restResourceMock->expects($this->atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransferMocks);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getValidationMessages')
            ->willReturn($this->messageTransferMocks);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('getValue')
            ->willReturn($this->messageValue);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('getParameters')
            ->willReturn($this->messageParameters);

        $this->localeClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($this->currentLocale);

        $this->glossaryStorageClientInterfaceMock->expects($this->atLeastOnce())
            ->method('translate')
            ->willReturn($this->translatedString);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('setValue')
            ->willReturn($this->messageTransferMock);

        $this->messageTransferMock->expects($this->atLeastOnce())
            ->method('setParameters')
            ->willReturn($this->messageTransferMock);

        $this->restResourceMock->expects($this->atLeastOnce())
            ->method('getRelationships')
            ->willReturn(['items' => [$this->messageTransferMock]]);

        $this->assertIsArray(
            $this->quoteValidationMessageTranslatorRelationshipExpander->addResourceRelationships(
                $this->resources,
                $this->restRequestInterfaceMock
            )
        );
    }
}
