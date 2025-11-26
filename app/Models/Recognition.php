<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $quantity
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $icon
 * @property-read mixed $participants
 * @property-read mixed $remaining_days
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Affiliate> $affiliates
 * @property-read int|null $affiliates_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recognition whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recognition extends Model
{
    protected $guarded = ['id'];
    protected   $iconosReconocimientos = [
        'Inscripcion' => 'fas fa-user-plus text-danger',
        'Canaston' => 'fas fa-shopping-basket',
        '15 years' => 'fas fa-medal text-primary',
        '20 years' => 'fas fa-trophy text-secondary',
        '25 years' => 'fas fa-award text-info',
        '30 years' => 'fas fa-star text-warning',
        '35 years' => 'fas fa-certificate text-success',
        '40 years' => 'fas fa-medal text-dark',
    ];

    public function affiliates(): BelongsToMany
    {
        return $this->belongsToMany(Affiliate::class, 'affiliate_recognition');
    }
    public function Icon(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->iconosReconocimientos[$this->type] ?? 'fas fa-question-circle'
        );
    }
    public function IsDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->date>now()?true:false
        );
    }
    public function RemainingDays(): Attribute
    {
        $this->time = Carbon::parse($this->date);
        $this->time =  $this->time->diffForHumans(now());
        return Attribute::make(
            get: fn() => $this->time
        );
    }
    /* public function Participants(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->affiliates()->count()
        );
    } */
}
