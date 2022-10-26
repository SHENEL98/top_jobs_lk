<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Traits\Enums;

class Free extends Model
{
    // use Enums;
    use HasFactory;

    protected $fillable = [
        'label',
        'type',
        'product_id',
        'free_qty',
        'status',
        'lower_limit',
        'upper_limit',
    ];

    // protected $enumTypes = [
    //     'filat', 'multiple'
    // ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
