<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class EventPhoto extends Model
{
    protected $guarded = ['id'];
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
    protected function Image(): Attribute
    {
        return Attribute::make(
            get: fn() =>  Storage::disk('public')->exists('event_photos/' . $this->name)
                ? Storage::disk('public')->url('event_photos/' . $this->name):Storage::disk('public')->url('event_photos/photo.png')
        );
    }
}
