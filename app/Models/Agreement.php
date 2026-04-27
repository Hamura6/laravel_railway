<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $images
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_view
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Social> $socials
 * @property-read int|null $socials_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Agreement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Agreement extends Model
{
    protected $guarded = ['id'];
    public function socials()
    {
        return $this->morphMany(Social::class, 'sociable');
    }
    protected function ImageView(): Attribute
    {
        return Attribute::make(
            get: fn() =>   Storage::disk('public')->url('agreements/' . $this->images)
        );
    }
    
}
