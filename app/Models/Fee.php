<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $amount
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Discount> $discounts
 * @property-read int|null $discounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fee whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fee extends Model
{
    protected $guarded = ['id'];
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function discounts(): BelongsToMany
    {
        return $this->belongsToMany(Discount::class, 'discount_fee');
    }
    public function plans()
    {
        // Relación a través de Payment
        return $this->hasManyThrough(Plan::class, Payment::class);
    }
}
