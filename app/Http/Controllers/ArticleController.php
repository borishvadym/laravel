<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ArticleServiceContract;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TagResource;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * @var ArticleServiceContract
     */
    private ArticleServiceContract $service;

    /**
     * @var Article
     */
    private Article $model;

    public function __construct(ArticleServiceContract $service, Article $article)
    {
        $this->service = $service;
        $this->model = $article;
    }

    /**
     * Show articles list
     * @throws AuthorizationException
     */
    public function index(): Factory|View|Application
    {
        $this->authorize('viewAny', Article::class);
        $articles = $this->model->with('category')->latest()->paginate(25);
        return view('admin.article.index', [
            'articles' => ArticleResource::collection($articles),
            'links' => $articles->links(),
        ]);
    }

    /**
     * Creating new article form
     * @throws AuthorizationException
     */
    public function create(): Factory|View|Application
    {
        $this->authorize('create', Article::class);
        $categories = Category::availableForArticles()->get();

        return view('admin.article.create', [
            'categories' => CategoryResource::collection($categories),
            'tags' => TagResource::collection(Tag::get()),
        ]);
    }

    /**
     * Store new article to database
     * @param  ArticleRequest $request
     * @return JsonResponse
     */
    public function store(ArticleRequest $request): JsonResponse
    {
        $article = $this->service->create($request);
        return $this->service->resultResponse($article);
    }

    /**
     * Edit existing article form
     * @param  Article $article
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function edit(Article $article): Factory|View|Application
    {
        $this->authorize('update', $article);
        $article->load('tags');
        $categories = Category::availableForArticles()->get();

        return view('admin.article.edit', [
            'article' => $article,
            'categories' => CategoryResource::collection($categories),
            'tags' => TagResource::collection(Tag::get()),
        ]);
    }

    /**
     * Update existing article in database
     * @param  ArticleRequest $request
     * @param  Article $article
     * @return JsonResponse
     */
    public function update(ArticleRequest $request, Article $article): JsonResponse
    {
        return $this->service->resultResponse($this->service->update($request, $article));
    }

    /**
     * Delete existing article
     * @param  Article $article
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function delete(Article $article): JsonResponse
    {
        $this->authorize('delete', $article);
        return $this->service->resultResponse($this->service->delete($article));
    }
}
