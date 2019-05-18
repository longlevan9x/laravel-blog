<?php

namespace App\Http\Controllers\Api\v1;

use App;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pika\Api\QueryBuilder;
use Pika\Api\RequestCreator;

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
        $model = new Category();
	    $queryBuilder= new QueryBuilder($model, $request);

        $queryBuilder->setDefaultUri(RequestCreator::createWithParameters(['includes' => 'translations', 'is_active' => 1]));

        $columns = $request->get('columns', '');

        $models = $queryBuilder->build()->get()->makeHidden(get_hidden_columns($model->getFillable(), $columns));

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
