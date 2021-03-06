<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'car_id',
        'date_from',
        'date_to',
        'total_cost',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The user relation
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id','user_id');
    }
    /**
     * The car relation
     */
    public function car()
    {
        return $this->hasOne('App\Models\Car', 'id','car_id');
    }
}
