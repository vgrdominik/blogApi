<?php

namespace App\Modules\Base\Traits;

interface DescriptiveInterface
{
    public function getReadableAttribute(): string;
    public function getShortReadableAttribute(): string;
    public function getLongReadableAttribute(): string;
}
