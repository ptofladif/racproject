<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'brand_id',
        'plate',
        'daily_price',
        'rented',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The brand relation
     */
    public function brand()
    {
        return $this->hasOne('App\Models\Brand', 'id','brand_id');
    }
}
