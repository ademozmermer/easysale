<?php

namespace AdemOzmermer\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $guarded = [];

    protected $table = 'easysale_products';

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'base_price',
        'minimum_price',
        'status',
        'sort_by',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(Variant::class, 'easysale_product_variants', 'product_id', 'variant_id')
            ->withPivot('price', 'price_type');
    }
}
