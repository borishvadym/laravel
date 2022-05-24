<?php

namespace App\Http\Services;

use App\Contracts\Services\CategoryServiceContract;
use App\Models\Category;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryService extends BaseService implements CategoryServiceContract
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    /**
     * Category creating process
     * @param  FormRequest $request
     * @return Category
     */
    public function create(FormRequest $request): Category
    {
        return $this->model->create($this->prepareData($request));
    }

    /**
     * Category updating process
     * @param  FormRequest $request
     * @param  Category $category
     * @return bool
     */
    public function update(FormRequest $request, Category $category): bool
    {
        return $category->update($this->prepareData($request));
    }

    /**
     * Method for category deleting
     * @param  Category $category
     * @return bool|null
     * @throws Exception
     */
    public function delete(Category $category): ?bool
    {
//        if (!$category->articles()->exists()) {
            return $category->delete();
//        }

//        return false;
    }

    /**
     * Method for preparing data before creating or updating row in DB
     * @param  FormRequest $request
     * @return array
     */
    public function prepareData(FormRequest $request): array
    {
        $data = $request->validated();
        $data['parent_id'] = $request->input('parent_id', 0);
        $data['slug'] = Str::slug($data['title']);

        return $data;
    }

    /**
     * Update categories sorting
     * @param  array $rows
     * @return bool
     */
    public function updateSorting(array $rows = []): bool
    {
        foreach ($rows as $row) {
            $this->updateRowSorting($row['id'] ?? 0, $row['sort_order'] ?? 0);
        }
        return true;
    }

    /**
     * Update sorting in category row
     * @param  int $id
     * @param  int $position
     * @return bool
     */
    public function updateRowSorting(int $id = 0, int $position = 0): bool
    {
        return $this->model->whereId($id)->update(['sort_order' => $position]);
    }
}
