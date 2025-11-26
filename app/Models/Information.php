<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $image_view
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Information extends Model
{
    protected $guarded = ['id'];
    protected function ImageView(): Attribute
    {
        return Attribute::make(
            get: fn() =>   Storage::disk('public')->url('news/' . $this->image)
        );
    }
}
