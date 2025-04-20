<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Pet",
 *     type="object",
 *     title="Pet",
 *     description="Modelo de mascota",
 *     required={"name", "species", "person_id"},
 *     @OA\Property(property="id", type="integer", readOnly=true, example=1),
 *     @OA\Property(property="name", type="string", example="Firulais"),
 *     @OA\Property(property="species", type="string", example="Perro"),
 *     @OA\Property(property="breed", type="string", example="Labrador"),
 *     @OA\Property(property="age", type="integer", example=3),
 *     @OA\Property(property="image", type="string", example="https://example.com/images/firulais.jpg"),
 *     @OA\Property(property="person_id", type="integer", example=12)
 * )
 */

class Pet extends Model
{
    use HasFactory;

    protected $table = "pets";

    protected $fillable = [
        'name',
        'species',
        'breed',
        'age',
        'image',
        'person_id'
    ];

    public function person()
    {
        return $this->belongsTo(People::class);
    }
}
