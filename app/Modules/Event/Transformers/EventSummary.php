<?php

namespace App\Modules\Event\Transformers;

use App\Modules\Base\Transformers\BaseTransformer;
use App\Modules\Event\Domain\Event as EventModel;

class EventSummary extends BaseTransformer
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
            'id' => $this->id,
            'reservated_at' => $this->reservated_at,
        ];
    }
}
