<?php


namespace AdemOzmermer\Entity;


use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $guarded = [];

    protected $table = 'easysale_variants';

    protected $fillable = [
        'option_id',
        'name',
        'sort_by'
    ];
}
