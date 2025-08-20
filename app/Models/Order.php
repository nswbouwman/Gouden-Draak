<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['table_nr'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
