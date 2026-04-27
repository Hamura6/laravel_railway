<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string $url
 * @property int $sociable_id
 * @property string $sociable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $color
 * @property-read mixed $icon
 * @property-read Model|\Eloquent $sociable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereSociableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereSociableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Social whereUrl($value)
 * @mixin \Eloquent
 */
class Social extends Model
{
    protected $fillable = ['type', 'url'];
    public function sociable()
    {
        return $this->morphTo();
    }
    protected function Icon(): Attribute
    {
        return Attribute::make(
            get: fn() => [
                'facebook' => 'fab fa-facebook',
                'twitter' => 'fab fa-twitter',
                'linkedin' => 'fab fa-linkedin',
                'instagram' => 'fab fa-instagram',
                'web' => 'fas fa-globe',
            ][$this->type] ?? 'fas fa-share-alt'
        );
    }
    protected function Color(): Attribute
    {
        return Attribute::make(
            get: fn() => [
                'facebook' => 'dark',
                'twitter' => 'info',
                'linkedin' => 'dark',
                'instagram' => 'danger',
                'web' => 'success',
            ][$this->type] ?? 'secondary'
        );
    }
}
