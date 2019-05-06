<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostRequest
 * @package App\Http\Requests
 * @property array $tags
 */
class PostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 * @return array
	 */
	public function rules() {
		return [
			'title'           => 'required|max:191',
			'slug'            => 'max:191',
			'category_id'     => 'integer',
			'image'           => 'image',
			'is_active'       => 'integer',
			'is_comment'      => 'integer',
			'overview'        => 'max:1000',
			'content'         => 'max:65000',
			'seo_title'       => 'max:500',
			'seo_keyword'     => 'max:500',
			'seo_description' => 'max:65000'
		];
	}
}