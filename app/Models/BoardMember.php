<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoardMember extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function affiliate():BelongsTo{
        return $this->belongsTo(Affiliate::class);
    }
    public function label(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->is_directory?'Directorio':'Tribunal de Honor'
        );
    }
}
