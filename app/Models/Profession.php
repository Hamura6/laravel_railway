<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $area
 * @property string $date
 * @property int $affiliate_id
 * @property int $university_id
 * @property int $specialty_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate $affiliate
 * @property-read \App\Models\Specialty $specialty
 * @property-read \App\Models\University $university
 * @method static \Database\Factories\ProfessionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereSpecialtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereUniversityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profession whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Profession extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function affiliate():BelongsTo{
        return $this->belongsTo(Affiliate::class);
    }
    public function specialty():BelongsTo{
        return $this->belongsTo(Specialty::class);
    }
    public function university():BelongsTo{
        return $this->belongsTo(University::class);
    }
}
