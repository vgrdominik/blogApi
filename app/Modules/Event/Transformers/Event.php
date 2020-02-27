<?php

namespace App\Modules\Event\Transformers;

use App\Modules\Base\Transformers\BaseTransformer;
use App\Modules\Event\Domain\Event as EventModel;

class Event extends BaseTransformer
{

    /**
     * The resource instance.
     *
     * @var mixed|EventModel
     */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->merge(parent::toArray($request)),
            'details' => $this->details,
            'creator' => new BaseTransformer($this->creator),
            'destinator' => new BaseTransformer($this->destinator),
            'reservated_at' => $this->reservated_at,
        ];
    }
}
