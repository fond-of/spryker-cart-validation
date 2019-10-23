<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship;

use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class QuoteValidationMessageTranslatorRelationshipExpander implements QuoteValidationMessageTranslatorRelationshipExpanderInterface
{
    protected const RESOURCE_ITEMS = 'items';

    /**
     * @var \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface
     */
    protected $glossaryStorageClient;

    /**
     * @var \Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClient;

    /**
     * @param \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface $glossaryStorageClient
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     */
    public function __construct(
        GlossaryStorageClientInterface $glossaryStorageClient,
        LocaleClientInterface $localeClient
    ) {
        $this->glossaryStorageClient = $glossaryStorageClient;
        $this->localeClient = $localeClient;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): array
    {
        foreach ($resources as $resource) {

            $payload = $resource->getPayload();

            if ($payload instanceof QuoteTransfer) {
                $this->translateQuoteTransferItems($payload);
            }

            $this->translateItemsResourceRelationships($resource);
        }

        return $resources;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    protected function translateQuoteTransferItems(QuoteTransfer $quoteTransfer): void
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            foreach ($itemTransfer->getValidationMessages() as $validationMessage) {
                $this->translateValidationMessage($validationMessage);
            }
        }
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResource $resource
     *
     * @return void
     */
    protected function translateItemsResourceRelationships(RestResource $resource) : void
    {
        foreach ($resource->getRelationships() as $resourceName => $relationshipResourceArray) {
            if ($resourceName !== static::RESOURCE_ITEMS) {
                continue;
            }

            foreach ($relationshipResourceArray as $relationshipResource) {
                if (!($relationshipResource instanceof RestResource)
                    || !($relationshipResource->getAttributes() instanceof RestItemsAttributesTransfer)) {
                    continue;
                }

                foreach ($relationshipResource->getAttributes()->getValidationMessages() as $validationMessage) {
                    $this->translateValidationMessage($validationMessage);
                }
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\MessageTransfer $validationMessage
     *
     * @return \Generated\Shared\Transfer\MessageTransfer
     */
    protected function translateValidationMessage(MessageTransfer $validationMessage) : MessageTransfer
    {
        return $validationMessage->setValue(
            $this->translate(
                $validationMessage->getValue(),
                $validationMessage->getParameters()
            )
        )->setParameters([]);
    }

    /**
     * @param string $translationKey
     * @param array $parameters
     *
     * @return string
     */
    protected function translate(string $translationKey, array $parameters): string
    {
        return $this->glossaryStorageClient->translate(
            $translationKey,
            $this->localeClient->getCurrentLocale(),
            $parameters
        );
    }
}
