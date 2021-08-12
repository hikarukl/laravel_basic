<?php


namespace App\Services;

use App\Constants\CommonConstants;
use App\Models\Category as CategoryModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Category
{
    /**
     * Get list with pagination
     *
     * @param array $options
     *
     * @return LengthAwarePaginator
     *
     */
    public function getAllListPagination($options)
    {
        return CategoryModel::paginate($options['limit']);
    }

    /**
     * Get all category
     *
     * @param array $options
     *
     * @return Collection
     *
     */
    public function getAllCategory(array $options)
    {
        $categoryCacheKey = CommonConstants::CACHE_CATEGORY_LIST_NAME;
        if (Cache::has($categoryCacheKey)) {
            return Cache::get($categoryCacheKey);
        }

        if (isset($options['status'])) {
            $categoryList = CategoryModel::where('status', $options['status'])->get();
        } else {
            $categoryList = CategoryModel::all();
        }
        Cache::put($categoryCacheKey, $categoryList);

        return $categoryList;
    }
}