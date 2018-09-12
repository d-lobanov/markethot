<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'id',
        'price',
        'amount',
        'sales',
        'article',
    ];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
