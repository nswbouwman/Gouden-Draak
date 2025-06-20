<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'dish_type_id',
        'menu_number',
        'menu_suffix',
        'name',
        'description',
        'price',
    ];

    public function dishType()
    {
        return $this->belongsTo(DishType::class);
    }
}
