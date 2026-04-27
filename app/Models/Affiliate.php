<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Affiliate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function license(): HasOne
    {
        return $this->hasOne(License::class);
    }

    public function deceased(): HasOne
    {
        return $this->hasOne(Deceased::class);
    }

    public function profession(): HasOne
    {
        return $this->hasOne(Profession::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function professions(): HasMany
    {
        return $this->hasMany(Profession::class);
    }
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }
    public function demands(): HasMany
    {
        return $this->hasMany(Demand::class);
    }
    public function recognitions(): BelongsToMany
    {
        return $this->belongsToMany(Recognition::class, 'affiliate_recognition');
    }
    public function boardMember():HasOne{
        return $this->hasOne(BoardMember::class);
    }



    public function plans()
    {
        return $this->hasManyThrough(
            Plan::class,          // Modelo final
            Payment::class,       // Modelo intermedio
            'affiliate_id',       // Clave foránea en payments que apunta a affiliates
            'payment_id',         // Clave foránea en plans que apunta a payments
            'id',                 // Clave local en affiliates
            'id'                  // Clave local en payments
        );
    }



    /*  public function Status(): Attribute
    {
         $count = $this->plans()->where('status', 'Por pagar');
        return Attribute::make(
            get: fn() => 'Por pagar',
        );
    } */

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->calculateTotal()
        );
    }
    private function calculateTotal(): float
    {
        return $this->payments->sum(function ($pay) {
            if ($pay->status === 'Pagado') {
                return $pay->amount;
            }

            return collect($pay->plans)->sum('amount');
        });
    }
    public function debt(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->payments->sum('amount') - $this->total
        );
    }
    public function debtAportCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->payments->where('feed_id',1)->where('status','Por pagar')->count()
        );
    }


    public function age(): Attribute
    {
        if (!$this->user || !$this->user->birthdate) {
        return Attribute::make(get: fn() => null); // o 'N/A'
    }
        $birthdate = Carbon::parse($this->user->birthdate);
        $age = $birthdate?->diff(Carbon::now());
        return Attribute::make(
            get: fn() => "{$age->y} anios, {$age->m} meses y {$age->d} dias"
        );
    }

    public function Antique(): Attribute
    {
        $antique = Carbon::parse($this->created_at);
        $year = $antique->diff(Carbon::now());
        return Attribute::make(
            get: fn() => "{$year->y} a, {$year->m} m y {$year->d} d"
        );
    }
    public function Year(): Attribute
    {
        $antique = Carbon::parse($this->created_at);
        $year = $antique->diff(Carbon::now());
        return Attribute::make(
            get: fn() => $year->y
        );
    }
    public function Situation(): Attribute
    {

        $status = ($this->payments->count() < 24 && $this->status == 'Activo' && $this->year >= 15) ? 'Habilitado' : 'Deshabilitado';
        return Attribute::make(
            get: fn() => $status
        );
    }
    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y')
        );
    }
}
