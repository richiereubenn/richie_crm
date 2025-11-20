<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'subscription_period',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
