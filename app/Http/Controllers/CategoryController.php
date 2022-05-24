<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoryServiceContract;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryServiceContract
     */
    private CategoryServiceContract $service;

    /**
     * @var Category
     */
    private Category $model;

    public function __construct(CategoryServiceContract $service, Category $category)
    {
        $this->service = $service;
        $this->model = $category;
    }

    /**
     * Show categories list
     * @throws AuthorizationException
     */
    public function index(): Factory|View|Application
    {
        $this->authorize('viewAny', Category::class);
        $categories = $this->model->sorted()->root()->with('subCategories')->get();
        return view('admin.category.index', ['categories' => CategoryResource::collection($categories)]);
    }

    /**
     * Creating new category form
     * @throws AuthorizationException
     */
    public function create(): Factory|View|Application
    {
        $this->authorize('create', Category::class);
        $categories = $this->model->root()->get();
        return view('admin.category.create', ['categories' => CategoryResource::collection($categories)]);
    }

    /**
     * Store new category to database
     * @param  CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = $this->service->create($request);
        return $this->service->resultResponse($category, data: CategoryResource::make($category));
    }

    /**
     * Edit existing category form
     * @param  Category $category
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function edit(Category $category): Factory|View|Application
    {
        $this->authorize('update', $category);
        $categories = $this->model->root()->get();
        return view('admin.category.edit', ['category' => $category, 'categories' => CategoryResource::collection($categories)]);
    }

    /**
     * Update existing category in database
     * @param  CategoryRequest $request
     * @param  Category $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        return $this->service->resultResponse($this->service->update($request, $category), data: CategoryResource::make($category));
    }

    /**
     * Delete existing category
     * @param  Category $category
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function delete(Category $category): JsonResponse
    {
        $this->authorize('delete', $category);
        return $this->service->resultResponse($this->service->delete($category));
    }

    /**
     * Update categories sorting
     * @param  Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function sortingUpdate(Request $request): JsonResponse
    {
        $this->authorize('update', $this->model);
        return $this->service->resultResponse($this->service->updateSorting($request->input('order', [])));
    }
}
