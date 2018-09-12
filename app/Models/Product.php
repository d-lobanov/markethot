<?php

namespace Market\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Market\ElasticScout\MarketIndexConfigurator;
use Market\ElasticScout\ProductSearchRule;
use ScoutElastic\Searchable;

/**
 * @property int $sales
 * @method static Product updateOrCreate(array $key, array $values)
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
