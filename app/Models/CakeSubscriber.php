<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeSubscriber extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'cake_id',
        'user_id',
    ];
}
