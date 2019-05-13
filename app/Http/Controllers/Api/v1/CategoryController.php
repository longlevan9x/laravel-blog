<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pika\Api\QueryBuilder;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api\v1
 */
class CategoryController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function index(Request $request) {
	    $queryBuilder= new QueryBuilder(new Category(), $request);

		$models = $queryBuilder->build()->get();
		return responseJson('success', $models, config('api_response.status.success'));
	}

	/**
	 * @param $slug
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function showBySlug($slug) {
		$model = Category::findBySlugOrFail($slug);
		if (isset($model)) {
			return responseJson('success', $model, 200);
		}

		return responseJson('fail', __('admin/common.not found'), 200);
	}
}
