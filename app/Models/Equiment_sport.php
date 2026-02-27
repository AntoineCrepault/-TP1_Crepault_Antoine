<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;


class Equiment_sport extends Model
{
    use HasFactory;
    protected $fillable = [
        'sport_id',
        'equipment_id'
    ];

    public function sport() : belongsToMany {
        return $this->belongsToMany('\App\Models\Sport');
    }

    public function equipment() : belongsToMany {
        return $this->belongsToMany('\App\Models\Equipment');
    }
}
