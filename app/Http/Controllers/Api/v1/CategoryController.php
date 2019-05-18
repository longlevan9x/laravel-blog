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
    protected $queryBuilder;
    protected $repository;
    protected $request;

    /**
     * CategoryController constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
        $this->repository = new Category();
        $this->queryBuilder = new QueryBuilder($this->repository, $request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function index() {
        $this->queryBuilder->setDefaultUri(RequestCreator::createWithParameters(['includes' => 'translations', 'is_active' => 1]));
        $columns = $this->request->get('columns', '');
        $models = $this->queryBuilder->build()->get()->makeHidden(get_hidden_columns($this->repository->getFillable(), $columns));

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWithIsHome(Request $request) {
        $this->queryBuilder->setDefaultUri(RequestCreator::createWithParameters(['includes' => 'translations', 'is_active' => 1, 'is_home' => 1]));
        $columns = $this->request->get('columns', '');
        $models = $this->queryBuilder->build()->get()->makeHidden(get_hidden_columns($this->repository->getFillable(), $columns));

        return responseJson('success', $models, config('api_response.status.success'));
    }
}
