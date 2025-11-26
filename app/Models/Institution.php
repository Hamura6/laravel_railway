<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Institution extends Model
{
    protected $guarded = ['id'];
    protected $label = [
    'LP' => 'La paz',
    'PT' => 'Potosí',
    'OR' => 'Oruro',
    'CB' => 'Cochabamba',
    'SC' => 'Santa Cruz',
    'TJ' => 'Tarija',
    'CH' => 'Cochabamba',
    'BN' => 'Beni',
    'PD' => 'Pando'
];
    protected function Image(): Attribute
    {
        return Attribute::make(
            get: fn() =>  Storage::disk('public')->url('institution/' . $this->logo)
        );
    }
    public function cityLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->label[$this->city]
        );
    }
}
