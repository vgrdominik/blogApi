<?php


namespace App\Modules\Event\Infrastructure\Controller;

use App\Modules\Base\Domain\BaseDomain;
use App\Modules\Base\Infrastructure\Controller\ResourceController;
use App\Modules\Event\Transformers\EventSummary;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Api extends ResourceController
{
    protected function getModelName(): string
    {
        return 'Event';
    }

    /**
     * Display a listing of own resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(($this->getTransformerClass())::collection(($this->getModelClass())::where('creator_id', auth()->user()->id)->orWhere('destinator_id', auth()->user()->id)->orderBy('created_at', 'desc')->get()));
    }

    /**
     * Display a listing of summary resource.
     *
     * @return JsonResponse
     */
    public function eventSummary()
    {
        return response()->json(EventSummary::collection(($this->getModelClass())::all()));
    }
}
