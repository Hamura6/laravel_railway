<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $guarded = ['id'];
    public function photos(): HasMany
    {
        return $this->hasMany(EventPhoto::class, 'event_id');
    }
    public function firstPhoto()
    {
        return $this->hasOne(EventPhoto::class)->latest();
    }
}
