<?php

namespace FondOfSpryker\Glue\CartValidation;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship\QuoteValidationMessageTranslatorRelationshipExpander;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Glue\Kernel\Container;

class CartValidationFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\CartValidation\CartValidationFactory
     */
    protected $cartValidationFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    protected $glossaryStorageClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->glossaryStorageClientInterfaceMock = $this->getMockBuilder(GlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientInterfaceMock = $this->getMockBuilder(LocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartValidationFactory = new CartValidationFactory();
        $this->cartValidationFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteValidationMessageTranslatorRelationshipExpander(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CartValidationDependencyProvider::CLIENT_GLOSSARY_STORAGE],
                [CartValidationDependencyProvider::CLIENT_LOCALE]
            )->willReturnOnConsecutiveCalls(
                $this->glossaryStorageClientInterfaceMock,
                $this->localeClientInterfaceMock
            );

        $this->assertInstanceOf(
            QuoteValidationMessageTranslatorRelationshipExpander::class,
            $this->cartValidationFactory->createQuoteValidationMessageTranslatorRelationshipExpander()
        );
    }
}
