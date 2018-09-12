<?php

namespace Market\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Market\Models\Offer
 *
 * @property int $id
 * @property int|null $price
 * @property int|null $amount
 * @property int|null $sales
 * @property string|null $article
 * @property int $product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @method static Builder|Offer whereAmount($value)
 * @method static Builder|Offer whereArticle($value)
 * @method static Builder|Offer whereCreatedAt($value)
 * @method static Builder|Offer whereId($value)
 * @method static Builder|Offer wherePrice($value)
 * @method static Builder|Offer whereProductId($value)
 * @method static Builder|Offer whereSales($value)
 * @method static Builder|Offer whereUpdatedAt($value)
 * @mixin Eloquent
 */
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
