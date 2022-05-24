<?php

namespace App\Http\Services;

use App\Contracts\Services\BaseServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class BaseService implements BaseServiceContract
{
    /**
     * @var Model
     */
    protected Model $model;

    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * Return json response
     *
     * @param  $result
     * @param  string $successMessage
     * @param  string $errorMessage
     * @param  int $successStatus
     * @param  int $errorStatus
     * @param  mixed|null $data
     * @return JsonResponse
     */
    public function resultResponse($result, string $successMessage = '', string $errorMessage = '', int $successStatus = 200, int $errorStatus = 422, mixed $data = null): JsonResponse
    {
        if ($result) {
            return response()->json(['status' => true, 'message' => $successMessage ?: __('messages.response.success'), 'data' => $data ?: $result], $successStatus);
        }

        return response()->json(['status' => false, 'message' => $errorMessage ?: __('messages.response.error')], $errorStatus);
    }

    /**
     * Return bool value
     *
     * @param  mixed $value
     * @return bool
     */
    public function getBoolValue($value = 0): bool
    {
        return boolval($value);
    }

    /**
     * Update model activity status
     *
     * @param  Model $model
     * @param  string $activeField
     * @return bool
     */
    public function changeActivity(Model $model, $activeField = 'is_active'): bool
    {
        return $model->update([$activeField => !$model->$activeField]);
    }

    /**
     * Store files to database
     *
     * @param  array $data
     * @param  FormRequest $request
     * @param  array $fields
     * @param  string $path
     */
    public function storeFiles(array &$data, FormRequest $request, array $fields, string $path = '')
    {
        foreach($fields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store($path);
            }
        }
    }
}
