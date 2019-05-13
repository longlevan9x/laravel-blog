<?php

namespace App\Models;

use App\Models\Admins;
use App\Models\Interfaces\IModelMeta;
use App\Models\Post;
use App\Models\Traits\ModelMetaTrait;
use App\Models\Traits\ModelTrait;
use App\Models\Traits\ModelUploadTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Yadakhov\InsertOnDuplicateKey;

/**
 * Class PostMeta
 *
 * @package App\Models
 * @method static Builder whereKey(string $key)
 * @property int            $id
 * @property int|null       $post_id
 * @property string|null    $key
 * @property string|null    $value
 * @property Carbon|null    $created_at
 * @property Carbon|null    $updated_at
 * @property-read Admins    $authorUpdated
 * @property-read Post|null $post
 * @method static Builder|PostMeta findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|PostMeta whereCreatedAt($value)
 * @method static Builder|PostMeta whereId($value)
 * @method static Builder|PostMeta wherePostId($value)
 * @method static Builder|PostMeta whereSlug($slug)
 * @method static Builder|PostMeta whereUpdatedAt($value)
 * @method static Builder|PostMeta whereValue($value)
 * @mixin \Eloquent
 * @method static Builder|PostMeta active($value = 1)
 * @method static Builder|PostMeta inActive()
 * @property-read Admins    $author
 * @method static Builder|PostMeta orderBySortOrder()
 * @method static Builder|PostMeta orderBySortOrderDesc()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta myPluck($column, $key = null, $title = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta withTranslations()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Relationship[] $relationships
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostMeta postTime($time = '')
 */
class PostMeta extends Model implements IModelMeta
{
	use ModelTrait;
	use ModelMetaTrait;

	const KEY_IS_BANNER      = '_is_banner';
	const KEY_BANNER_CONTENT = '_banner_content';
	protected $fillable = ['post_id', 'key', 'value'];

	/**
	 * @return string
	 */
	public function fieldForeignKey() {
		// TODO: Implement fieldForeignKey() method.
		return 'post_id';
	}
}
