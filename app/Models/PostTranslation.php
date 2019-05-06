<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostTranslation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $post_id
 * @property string $title
 * @property string|null $overview
 * @property string|null $content
 * @property string|null $seo_title
 * @property string|null $seo_keyword
 * @property string|null $seo_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $locale
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereSeoKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostTranslation whereUpdatedAt($value)
 */
class PostTranslation extends Model
{
	protected $fillable = ['post_id', 'title', 'overview', 'content', 'seo_title', 'seo_keyword', 'seo_description'];
}
