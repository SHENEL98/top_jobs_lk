<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'free_id',
        'free_qty', 
        'qty',
        'unit_price',
        'amount'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function free()
    {
        return $this->belongsTo('App\Models\Free', 'free_id');
    }
}
