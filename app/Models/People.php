<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $table = "people";

    protected $fillable = [
        'name',
        'email',
        'birthday'
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class, 'person_id');
    }
}
