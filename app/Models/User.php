<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'email',
    ];

    public function cakesSubscribers(): HasMany
    {
        return $this->hasMany(CakeSubscriber::class);
    }
}
