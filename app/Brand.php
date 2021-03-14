<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'title',
        'name',
        'icon',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
