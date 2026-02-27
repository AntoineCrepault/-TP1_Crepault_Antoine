<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'rental_id'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo('\App\Models\User');
    }

    public function rental() : BelongsTo {
        return $this->belongsTo('\App\Models\Rental');
    }

    
}
