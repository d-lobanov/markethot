<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Market\ElasticScout\MarketIndexConfigurator;
use Market\ElasticScout\ProductSearchRule;
use ScoutElastic\Searchable;

/**
 * Market\Models\Product
 *
 * @property int $sales
 * @method static Product updateOrCreate(array $key, array $values)
 * @property int $id
 * @property string $title
 * @property string|null $image
 * @property string|null $description
 * @property string|null $first_invoice
 * @property string|null $url
 * @property int|null $price
 * @property int|null $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Category[] $categories
 * @property-read Collection|Offer[] $offers
 * @method static Builder|Product whereAmount($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereFirstInvoice($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereUrl($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use Searchable;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'id',
        'title',
        'image',
        'description',
        'first_invoice',
        'url',
        'price',
        'amount',
    ];

    /**
     * @var string
     */
    protected $indexConfigurator = MarketIndexConfigurator::class;

    /**
     * Elasticsearch rules
     * @var array
     */
    protected $searchRules = [
        ProductSearchRule::class
    ];

    /**
     * Elasticsearch mapping
     * @var array
     */
    protected $mapping = [
        'properties' => [
            'title' => [
                'type' => 'string',
            ],
            'description' => [
                'type' => 'string',
            ],
        ]
    ];

    /**
     * {@inheritdoc}
     */
    public function toSearchableArray()
    {
        return array_merge($this->toArray(), [
            'offers' => $this->offers->toArray(),
        ]);
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasMany|Offer[]
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    /**
     * @return int
     */
    public function getSalesAttribute()
    {
        return $this->offers()->sum('sales');
    }
}
