<?php


namespace App\Http\Controllers\Admin;


use App\Constants\CommonConstants;
use App\Services\Category;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController
{
    /**
     * @var Category
     */
    protected $categoryService;

    public function __construct(Category $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        try {
            /*$dataReceived = $request->getQueryString()? Query::parse($request->getQueryString()) : [];

            $dataSearch = [
                'limit' => isset($dataReceived['limit']) && $dataReceived['limit'] ? $dataReceived['limit'] : CommonConstants::DEFAULT_LIMIT_SEARCH,
            ];

            $dataSearch = array_merge($dataReceived, $dataSearch);

            $data['category_list'] = $this->categoryService->getAllListPagination($dataSearch)
                ->appends(request()->query());*/
            $data = [
                'breadCrumb' => 'Category'
            ];

            return view("admin.category.index", $data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());
        }
    }
}
