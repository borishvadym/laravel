<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Http\Services\BaseService;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * @var Tag
     */
    private Tag $model;

    /**
     * @var BaseService
     */
    private BaseService $service;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
        $this->service = new BaseService($tag);
    }

    /**
     * Show tags list
     * @throws AuthorizationException
     */
    public function index(): Factory|View|Application
    {
        $this->authorize('viewAny', Tag::class);
        $tags = $this->model->paginate(25);
        return view('admin.tag.index', ['tags' => TagResource::collection($tags)]);
    }

    /**
     * Creating new tag form
     * @throws AuthorizationException
     */
    public function create(): Factory|View|Application
    {
        $this->authorize('create', Tag::class);
        return view('admin.tag.create');
    }

    /**
     * Store new tag to database
     * @param  TagRequest $request
     * @return JsonResponse
     */
    public function store(TagRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->input('name'));
        $tag = $this->model->create($data);

        return $this->service->resultResponse($tag, data: TagResource::make($tag));
    }

    /**
     * Edit existing tag form
     * @param  Tag $tag
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function edit(Tag $tag): Factory|View|Application
    {
        $this->authorize('update', $tag);
        return view('admin.tag.edit', ['tag' => $tag]);
    }

    /**
     * Update existing tag in database
     * @param  TagRequest $request
     * @param  Tag $tag
     * @return JsonResponse
     */
    public function update(TagRequest $request, Tag $tag): JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->input('name'));
        return $this->service->resultResponse($tag->update($data), data: TagResource::make($tag));
    }

    /**
     * Delete existing tag
     * @param  Tag $tag
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function delete(Tag $tag): JsonResponse
    {
        $this->authorize('delete', $tag);
        return $this->service->resultResponse($tag->delete());
    }
}
