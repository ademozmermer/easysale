<?php


namespace AdemOzmermer\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    protected $guarded = [];

    protected $table = 'easysale_options';

    protected $fillable = [
        'name',
        'sort_by'
    ];

    /**
     * @return HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class, 'option_id')->orderBy('sort_by', 'ASC');
    }
}
