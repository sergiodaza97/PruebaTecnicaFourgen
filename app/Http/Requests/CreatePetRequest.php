<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreatePetRequest",
 *     title="Crear mascota",
 *     required={"name", "species", "person_id"},
 *     @OA\Property(property="name", type="string", example="Toby"),
 *     @OA\Property(property="species", type="string", example="Gato"),
 *     @OA\Property(property="person_id", type="integer", example=12)
 * )
 */

class CreatePetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            // 'breed' => 'required|string|max:255',
            // 'age' => 'required|integer',
            // 'image' => 'required|url',
            'person_id' => 'required|exists:people,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'species.required' => 'La especie es obligatoria.',
            // 'breed.required' => 'La raza es obligatoria.',
            // 'age.required' => 'La edad es obligatoria.',
            // 'image.required' => 'La imagen es obligatoria.',
            'person_id.required' => 'El ID de la persona es obligatorio.',
        ];
    }
}
