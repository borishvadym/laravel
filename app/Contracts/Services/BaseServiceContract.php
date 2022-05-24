<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;

interface BaseServiceContract
{
    public function resultResponse($result, string $successMessage = '', string $errorMessage = '', int $successStatus = 200, int $errorStatus = 422);

    public function getBoolValue($value = 0);

    public function changeActivity(Model $model, $activeField = 'is_active');
}
