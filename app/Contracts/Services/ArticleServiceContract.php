<?php

namespace App\Contracts\Services;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

interface ArticleServiceContract
{
    public function create(FormRequest $request);

    public function update(FormRequest $request, Article $article);

    public function delete(Article $article);

    public function prepareData(FormRequest $request);
}
