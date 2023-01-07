<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cake extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'weight',
        'price',
        'available_quantity',
    ];

    public function cakesSubscribers(): BelongsToMany
    {
        return $this->belongsToMany(CakeSubscriber::class);
    }
}
