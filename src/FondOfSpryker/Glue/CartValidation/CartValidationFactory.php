<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CartValidation;

use FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship\QuoteValidationMessageTranslatorRelationshipExpander;
use FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship\QuoteValidationMessageTranslatorRelationshipExpanderInterface;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Glue\CartValidation\CartValidationConfig getConfig()
 */
class CartValidationFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship\QuoteValidationMessageTranslatorRelationshipExpanderInterface
     */
    public function createQuoteValidationMessageTranslatorRelationshipExpander(): QuoteValidationMessageTranslatorRelationshipExpanderInterface
    {
        return new QuoteValidationMessageTranslatorRelationshipExpander(
            $this->getGlossaryStorageClient(),
            $this->getLocaleClient()
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    public function getGlossaryStorageClient(): GlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CartValidationDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }

    /**
     * @throws
     *
     * @return \Spryker\Client\Locale\LocaleClientInterface
     */
    public function getLocaleClient(): LocaleClientInterface
    {
        return $this->getProvidedDependency(CartValidationDependencyProvider::CLIENT_LOCALE);
    }
}
