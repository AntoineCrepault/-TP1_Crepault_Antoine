<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    protected $table = 'rentals';
    public $timestamps = false;
   
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'total_price',
        'user_id',
        'equipment_id'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo('\App\Models\User');
    }

    public function equipment() : BelongsTo {
        return $this->belongsTo('\App\Models\Equipment');
    }

    public function review() : HasMany {
        return $this->hasMany('\App\Models\Review');
    }
}
