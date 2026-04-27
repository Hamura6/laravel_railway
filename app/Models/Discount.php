<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int $discount_value Porcentaje de descuento (0-99)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Fee> $fees
 * @property-read int|null $fees_count
 * @property-read mixed $is_active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount whereDiscountValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Discount whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Discount extends Model
{
   protected $guarded=['id'];
   public function getIsActiveAttribute()
    {
        $today = Carbon::today();
        return $today->between($this->start_date, $this->end_date);
    }
   public function fees(): BelongsToMany{
        return $this->belongsToMany(Fee::class,'discount_fee');
   }
}
