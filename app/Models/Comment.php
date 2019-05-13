<?php

namespace App\Models;

use App\Models\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\Comment
 *
 * @property int         $id
 * @property int         $post_id
 * @property int|null    $parent_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $title
 * @property string|null $content
 * @property int|null    $is_active
 * @property string|null $status
 * @property int         $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Comment whereContent($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereEmail($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereIsActive($value)
 * @method static Builder|Comment whereName($value)
 * @method static Builder|Comment whereParentId($value)
 * @method static Builder|Comment wherePostId($value)
 * @method static Builder|Comment whereStatus($value)
 * @method static Builder|Comment whereTitle($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 * @mixin \Eloquent
 * @property-read Admins $authorUpdated
 * @method static Builder|Comment active($value = 1)
 * @method static Builder|Comment findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Comment inActive()
 * @method static Builder|Comment whereSlug($slug)
 * @property string|null $url
 * @property int         $is_admin
 * @method static Builder|Comment whereIsAdmin($value)
 * @method static Builder|Comment whereUrl($value)
 * @property-read Admins $author
 * @method static Builder|Comment orderBySortOrder()
 * @method static Builder|Comment orderBySortOrderDesc()
 * @property string|null $type
 * @method static Builder|Comment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment withTranslations()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment postTime($time = '')
 */
class Comment extends Model
{
	use ModelTrait;
	protected $fillable = ['post_id', 'post_id', 'parent_id', 'name', 'email', 'title', 'content', 'is_active', 'status', 'user_id', 'type', 'url', 'is_admin'];

	/**
	 * @return array|null|string
	 */
	public function getTextActive() {
		return __('admin/common.approved');
	}

	/**
	 * @return array|null|string
	 */
	public function getTextInActive() {
		return __('admin/common.unapproved');
	}

	public function getOtherTextActive() {
		return __('admin/common.hide');
	}

	/**
	 * @param Collection $comments
	 * @param int   $parent_id
	 * @param array $output
	 * @param int   $level
	 * @return array
	 */
	public function getRecursiveComments($comments, $parent_id = 0, &$output = [], $level = 0) {
		foreach ($comments as $comment) {
			/** @var Comment $comment */
			if ($comment->parent_id == $parent_id) {
				if ($comment->parent_id == 0) {
					$output[$comment->id] = [
						'item'     => $comment,
						'children' => []
					];
				}
				else {
					$output[$comment->parent_id]['children'][$comment->id] = [
						'item' => $comment,
					];
					//unset($comment->id);
				}
				$id = $comment->id;
				//unset($comment->id);
				$this->getRecursiveComments($comments, $id, $output, $level);
			}
		}

		return $output;
	}
}
