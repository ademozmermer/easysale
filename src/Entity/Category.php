<?php

namespace AdemOzmermer\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = [];

    protected $table = 'easysale_categories';

    protected $fillable = [
        'name',
        'image',
        'status',
        'sort_by',
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
