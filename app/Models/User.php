<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];

    public function review() : HasMany {
        return $this->hasMany('\App\Models\Review');
    }

    public function rental() : HasMany {
        return $this->hasMany('\App\Models\Rental');
    }

    

}
