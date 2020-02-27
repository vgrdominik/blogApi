<?php

namespace App\Modules\Base\Domain;

interface BaseDomainInterface
{
    public function getIcon(): string;
    public function getValidationContext(): array;
    public function remove(): bool;
}
