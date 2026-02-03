<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscription extends Model
{
    protected $fillable = ['name', 'token'];

    public function configs(): BelongsToMany
    {
        return $this->belongsToMany(Config::class);
    }
}
