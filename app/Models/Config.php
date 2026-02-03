<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Config extends Model
{
    protected $fillable = ['name', 'link'];

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class);
    }
}
