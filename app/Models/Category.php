<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
