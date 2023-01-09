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

    public function user(): User
    {
        return $this->belongsTo(related: User::class)->getResults();
    }

    public function cake(): Cake
    {
        return $this->belongsTo(related: Cake::class)->getResults();
    }
}
