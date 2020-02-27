<?php

namespace App\Modules\User\Transformers;

use App\Modules\Base\Transformers\BaseTransformer;
use App\Modules\Event\Transformers\Event;
use App\Modules\User\Domain\User as UserModel;

class User extends BaseTransformer
{

    /**
     * The resource instance.
     *
     * @var mixed|UserModel
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
            'own_events' => Event::collection($this->ownEvents),
            'assigned_events' => Event::collection($this->assignedEvents),
            'email' => $this->email,
        ];
    }
}
