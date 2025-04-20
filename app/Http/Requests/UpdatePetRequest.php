<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdatePetRequest",
 *     title="Actualizar mascota",
 *     @OA\Property(property="name", type="string", example="Toby"),
 *     @OA\Property(property="species", type="string", example="Gato"),
 *     @OA\Property(property="person_id", type="integer", example=12)
 * )
 */

class UpdatePetRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'species' => 'sometimes|required|string|max:255',
            // 'breed' => 'sometimes|required|string|max:255',
            // 'age' => 'sometimes|required|integer',
            // 'image' => 'sometimes|required|url',
            'person_id' => 'sometimes|required|exists:people,id',
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
