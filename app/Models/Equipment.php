<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'descrition',
        'daily_price',
        'category_id'
    ];

    public function categorie() : BelongsTo {
        return $this->belongsTo('\App\Models\Categorie');
    }

    public function rentals() : HasMany {
        return $this->hasMany('\App\Models\Rental');
    }

    public function equipmentsports() : HasMany {
        return $this->hasMany('\App\Models\Equimentsport');
    }
}
