<?php

namespace Market\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * Market\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Category|null $parent
 * @property-read Collection|Product[] $products
 * @method static Builder|Category whereAlias($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category whereTitle($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'id',
        'title',
        'alias',
        'parent',
        'parent_id',
    ];

    /**
     * @param $value
     */
    public function setParentAttribute($value)
    {
        $this->attributes['parent_id'] = $value;
    }

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
