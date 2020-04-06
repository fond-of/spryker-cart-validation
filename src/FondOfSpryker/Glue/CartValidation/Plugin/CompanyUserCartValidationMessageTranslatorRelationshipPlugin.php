<?php

declare(strict_types = 1);

namespace FondOfSpryker\Glue\CartValidation\Plugin;

use FondOfSpryker\Glue\CompanyUserCartsRestApi\CompanyUserCartsRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\CartValidation\CartValidationFactory getFactory()
 */
class CompanyUserCartValidationMessageTranslatorRelationshipPlugin extends AbstractPlugin implements ResourceRelationshipPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        $this->getFactory()
            ->createQuoteValidationMessageTranslatorRelationshipExpander()
            ->addResourceRelationships($resources, $restRequest);
    }

    /**
     * @return string
     */
    public function getRelationshipResourceType(): string
    {
        return CompanyUserCartsRestApiConfig::RESOURCE_COMPANY_USER_CARTS;
    }
}
