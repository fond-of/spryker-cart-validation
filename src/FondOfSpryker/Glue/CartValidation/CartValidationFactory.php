<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CartValidation;

use FondOfSpryker\Glue\CartValidation\Dependency\Client\CartValidationToGlossaryStorageClientInterface;
use FondOfSpryker\Glue\CartValidation\Dependency\Client\CartValidationToLocaleClientInterface;
use FondOfSpryker\Glue\CartValidation\Processor\Translator\ValidationMessageTranslator;
use FondOfSpryker\Glue\CartValidation\Processor\Translator\ValidationMessageTranslatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CartValidationFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\CartValidation\Processor\Translator\ValidationMessageTranslatorInterface
     */
    public function createValidationMessageTranslator(): ValidationMessageTranslatorInterface
    {
        return new ValidationMessageTranslator(
            $this->getGlossaryStorageClient(),
            $this->getLocaleClient()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\CartValidation\Dependency\Client\CartValidationToGlossaryStorageClientInterface
     */
    public function getGlossaryStorageClient(): CartValidationToGlossaryStorageClientInterface
    {
        return $this->getProvidedDependency(CartValidationDependencyProvider::CLIENT_GLOSSARY_STORAGE);
    }

    /**
     * @return \FondOfSpryker\Glue\CartValidation\Dependency\Client\CartValidationToLocaleClientInterface
     */
    public function getLocaleClient(): CartValidationToLocaleClientInterface
    {
        return $this->getProvidedDependency(CartValidationDependencyProvider::CLIENT_LOCALE);
    }
}
