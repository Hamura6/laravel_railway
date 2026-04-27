<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $complainant
 * @property string $phone
 * @property string $status
 * @property string $date
 * @property string $description
 * @property int $affiliate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate $affiliate
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereComplainant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Demand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Demand extends Model
{
    protected $guarded=['id'];
    public function affiliate():BelongsTo{
        return $this->belongsTo(Affiliate::class);
    }
}
