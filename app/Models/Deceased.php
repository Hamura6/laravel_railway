<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $date
 * @property string $mausoleum
 * @property string $description
 * @property int $affiliate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate $affiliate
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased whereMausoleum($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deceased whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Deceased extends Model
{
    protected $guarded=['id'];
    public function affiliate():BelongsTo{
        return $this->belongsTo(Affiliate::class);
    }
}
