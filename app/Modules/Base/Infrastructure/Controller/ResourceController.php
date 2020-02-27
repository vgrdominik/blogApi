<?php

namespace App\Modules\Base\Infrastructure\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Base\Domain\BaseDomain;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class ResourceController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(($this->getTransformerClass())::collection(($this->getModelClass())::orderBy('created_at', 'desc')->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     * @throws
     */
    public function store()
    {
        $modelClass = $this->getModelClass();
        $transformerClass = $this->getTransformerClass();
        /** @var BaseDomain $model */
        $model = new $modelClass();
        $validator = Validator::make(request()->all(), $model->getValidationContext());

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $model = new $modelClass(request()->all());
        $model->save();

        return response()->json(new $transformerClass($model));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $transformerClass = $this->getTransformerClass();
        $model = ($this->getModelClass())::findOrFail($id);

        return response()->json(new $transformerClass($model));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return JsonResponse
     * @throws
     */
    public function update($id)
    {
        $transformerClass = $this->getTransformerClass();
        /** @var BaseDomain $model */
        $model = ($this->getModelClass())::findOrFail($id);
        $validator = Validator::make(request()->all(), $model->getValidationContext());

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        $model->update(request()->all());

        return response()->json(new $transformerClass($model));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        /** @var BaseDomain $model */
        $model = ($this->getModelClass())::findOrFail($id);

        return response()->json($model->remove());
    }

    abstract protected function getModelName(): string;

    protected function getModelClass(): string
    {
        $modelName = $this->getModelName();

        return '\\App\\Modules\\' . $modelName . '\\Domain\\' . $modelName;
    }

    protected function getTransformerClass(): string
    {
        $modelName = $this->getModelName();

        return '\\App\\Modules\\' . $modelName . '\\Transformers\\' . $modelName;
    }
}
