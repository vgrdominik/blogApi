<?php

namespace App\Modules\Base\Domain;

use App\Modules\Base\Traits\Descriptive;
use App\Modules\Base\Traits\DescriptiveInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseDomain extends Model implements BaseDomainInterface, DescriptiveInterface
{
    use Descriptive;

    public function getValidationContext(): array
    {
        return [
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    public function __toString()
    {
        return $this->readable;
    }
}
