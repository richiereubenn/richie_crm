<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'project_id',
        'payment_status',   
        'payment_date',
        'expired_date',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'expired_date' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
