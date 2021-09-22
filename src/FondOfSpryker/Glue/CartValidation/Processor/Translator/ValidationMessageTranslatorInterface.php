<?php

namespace FondOfSpryker\Glue\CartValidation\Processor\Translator;

interface ValidationMessageTranslatorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function translate(array $resources): array;
}
