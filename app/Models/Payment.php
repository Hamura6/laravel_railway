<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $amount
 * @property string $status
 * @property string $date
 * @property string $type
 * @property int $fee_id
 * @property int $affiliate_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Affiliate $affiliate
 * @property-read \App\Models\Fee $fee
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Plan> $plans
 * @property-read int|null $plans_count
 * @method static \Database\Factories\PaymentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereAffiliateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereFeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUserId($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    /*    protected $appends = ['debt']; */
    /* public function getDebtAttribute()
    {
        // Calcula la deuda base
        $paid = array_key_exists('plans_sum_amount', $this->attributes)
            ? ($this->plans_sum_amount ?? 0)
            : $this->plans()->sum('amount');

        $debt = $this->amount - $paid;

        // Verifica si el fee tiene un descuento activo
        $today = now();
        $discount = $this->fee->discounts()
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        // Aplica el descuento si existe
        if ($discount) {
            $debt = $debt * (1 - ($discount->discount_value / 100));
        }

        return $debt;
    } */

    /*     public function getDebtAttribute()
    {
        // Usa la suma precargada si existe
        if (array_key_exists('plans_sum_amount', $this->attributes)) {
            return $this->amount - ($this->plans_sum_amount ?? 0);
        }

        // Sino, calcula en tiempo real
        return $this->amount - $this->plans()->sum('amount');
    } */



    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }
    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }
    public function fee(): BelongsTo
    {
        return $this->belongsTo(Fee::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /*  public function Status(): Attribute
    {
        $count = $this->plans()->where('status', 'Por pagar')->count();
        if ($count) {
            return Attribute::make(
                get: fn() => 'Por pagar',
            );
        } else {
            return Attribute::make(
                get: fn() => 'Pagado',
            );
        }
    } */
    /* public function Debt(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->status === "Pagado") {
                    return 0;
                }

                // Calcula siempre la suma actualizada
                $plansSum = $this->plans()->sum('amount');

                return $this->amount - $plansSum;
            }
        );
    } */
    /* public function Debt(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Si ya viene de la consulta (DB::raw), úsalo directamente
                if (array_key_exists('debt', $attributes)) {
                    return $attributes['debt'];
                }

                // Caso contrario, calcularlo manualmente (solo cuando se necesite)
                if ($this->status === "Pagado") {
                    return 0;
                }

                return $this->amount - $this->plans()->sum('amount');
            }
        );
    } */


    /*  public function scopeGroupedByUpdatedDate($query)
    {
        return $query->selectRaw("
                DATE(payments.updated_at) as updated_date,
                MIN(payments.date) as inicio,
                MAX(payments.date) as fin,
                SUM(payments.amount) as total,
                users.name,
                users.last_name,
                payments.type
            ")
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->where('payments.status', 'pagado')
            ->groupBy(
                DB::raw('DATE(payments.updated_at)'),
                'users.name',
                'users.last_name',
                'payments.type'
            )
            ->orderBy('updated_date', 'desc');
    } */
    public function getFechaDisplayAttribute()
    {
        Carbon::setLocale('es'); // aseguramos el idioma

        $date = Carbon::parse($this->date)->isoFormat('MMM-YYYY');
        $created = Carbon::parse($this->created_at)->isoFormat('MMM-YYYY');
        /* $date = strtoupper($date); */
        /* $created = strtoupper($created); */

        return $date === $created
            ? $date
            : "$created / $date";
    }
     public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y')
        );
    }
}
