<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Pika\Api\QueryBuilder;
use Pika\Api\RequestCreator;

class PostController extends Controller
{
	protected $queryBuilder;
	protected $repository;
	protected $request;

	/**
	 * PostController constructor.
	 * @param Request $request
	 */
	public function __construct(Request $request) {
		$this->request = $request;
		$this->repository = new Post();
		$this->queryBuilder = new QueryBuilder($this->repository, $request);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function index() {
		$this->queryBuilder->setDefaultUri(RequestCreator::createWithParameters(['includes' => 'translations', 'is_active' => 1]));
		$columns = $this->request->get('columns', '');
		$models = $this->queryBuilder->build()->paginate();
//		return view("auth.login");
		return responseJson('success', $models, config('api_response.status.success'));
	}

	/**
	 * @param $slug
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getBySlug($slug) {
		$model = Post::findBySlugOrFail($slug);
	    if (isset($model)) {
		    return responseJson('success', $model, 200);
	    }

	    return responseJson('fail', __('admin/common.not found'), 200);
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function postTop(Request $request) {
		$limit = $request->get('limit', 3);
		$columns = $request->get('columns', '*');
		$columns = explode(',', $columns);
		if (empty($columns)) {
			$columns = ["*"];
		}
		$models = Post::select($columns)->active()->with(['category:id,name,slug'])->limit($limit)->latest()->get();
	    return responseJson("success", $models, 200);
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function postPopular(Request $request) {
	    $order_by = $request->get('order_by', "created_at, desc");
	    list($column, $direction) = explode(",", $order_by);

		$limit = $request->get('limit', 6);
		$columns = $request->get('columns', '*');
		$columns = explode(',', $columns);
		if (empty($columns)) {
			$columns = ["*"];
		}

	    $models = Post::select($columns)->active()->with(['category:id,name,slug'])->limit($limit)->orderBy($column, $direction)->get();
	    return responseJson("success", $models, 200);
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function search(Request $request) {
	    $order_by = $request->get('order_by', "created_at, desc");
		list($column, $direction) = explode(",", $order_by);

		$columns = $request->get('columns', '*');
		$columns = explode(',', $columns);
		if (empty($columns)) {
			$columns = ["*"];
		}

		$keyword = $request->get('keyword', '');
        $limit = $request->get('limit', 6);

		$models = Post::active()->select($columns)->orderBy($column, $direction)->where('title', "LIKE", "%$keyword%")->limit($limit)->paginate();
		return responseJson("success", $models, 200);
    }
}
