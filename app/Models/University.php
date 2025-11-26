<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property string $entity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate|null $affiliate
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Profession> $professions
 * @property-read int|null $professions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|University whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class University extends Model
{
    protected $guarded=['id'];
    public function affiliate():HasOne{
        return $this->hasOne(Affiliate::class);
    }
    public function professions():HasMany{
        return $this->hasMany(Profession::class);
    }
}
