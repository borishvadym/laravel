<?php

namespace App\Contracts\Services;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

interface CategoryServiceContract
{
    public function create(FormRequest $request);

    public function update(FormRequest $request, Category $category);

    public function delete(Category $category);

    public function prepareData(FormRequest $request);
}
