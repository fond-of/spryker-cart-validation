<?php

namespace FondOfSpryker\Glue\CartValidation\Dependency\Client;

interface CartValidationToLocaleClientInterface
{
    public function getCurrentLocale(): string;
}
