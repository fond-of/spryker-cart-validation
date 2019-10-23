<?php

declare(strict_types=1);

namespace FondOfSpryker\Glue\CartValidation\Processor\Cart\Relationship;

use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface QuoteValidationMessageTranslatorRelationshipExpanderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): array;
}
