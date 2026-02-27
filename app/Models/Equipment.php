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
        'description',
        'daily_price',
        'category_id'
    ];

    public function category() : BelongsTo {
        return $this->belongsTo('\App\Models\Categorie');
    }

    public function rental() : HasMany {
        return $this->hasMany('\App\Models\Rental');
    }

    public function equipment_sport() : HasMany {
        return $this->hasMany('\App\Models\Equiment_sport');
    }
}
