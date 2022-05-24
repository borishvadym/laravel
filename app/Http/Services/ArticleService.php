<?php

namespace App\Http\Services;

use App\Contracts\Services\ArticleServiceContract;
use App\Models\Article;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ArticleService extends BaseService implements ArticleServiceContract
{
    public function __construct(Article $article)
    {
        parent::__construct($article);
    }

    /**
     * Article creating process
     * @param  FormRequest $request
     * @return Article
     */
    public function create(FormRequest $request): Article
    {
        $article = $this->model->create($this->prepareData($request));
        $this->syncTags($article, $request->input('tags', []));
        return $article;
    }

    /**
     * Article updating process
     * @param  FormRequest $request
     * @param  Article $article
     * @return bool
     */
    public function update(FormRequest $request, Article $article): bool
    {
        $result = $article->update($this->prepareData($request));
        $this->syncTags($article, $request->input('tags', []));
        return $result;
    }

    /**
     * Method for article deleting
     * @param  Article $article
     * @return bool|null
     * @throws Exception
     */
    public function delete(Article $article): ?bool
    {
        return $article->delete();
    }

    /**
     * Method for preparing data before creating or updating row in DB
     * @param  FormRequest $request
     * @return array
     */
    public function prepareData(FormRequest $request): array
    {
        $data = $request->validated();
        unset($data['tags']);

        $data['slug'] = Str::slug($data['title']);
        $data['is_active'] = $this->getBoolValue($request->input('is_active'));

        return $data;
    }

    /**
     * Sync article tags
     * @param  Article|null $article
     * @param  array $tags
     * @return bool|array
     */
    public function syncTags(Article $article = null, array $tags = []): bool|array
    {
        if ($article) {
            return $article->tags()->sync(collect($tags)->pluck('id')->toArray());
        }

        return false;
    }
}
