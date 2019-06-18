<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Pika\Api\QueryBuilder;

class HomeController extends Controller
{
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getListPostCategoryIsHome() {
		$categories = Category::withTranslation()->has('posts', ">=", 1)->whereIsHome(1)->whereIsActive(1)->latest()->limit(3)->select(['id', 'name'])->get();

		$posts = [];
		foreach ($categories as $index => $category) {
			$posts[$category->id] = Post::withTranslation()->whereCategoryId($category->id)->whereIsActive(1)->latest()->limit(10)->select(['id', 'title', 'image', 'slug'])->get();
		}

		return responseJson('success', ['categories' => $categories, 'posts' => $posts], config('api_response.status.success'));
	}
}
