<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Repositories\PetRepository;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Pets",
 *     description="Operaciones relacionadas con las mascotas"
 * )
 */

class PetController extends Controller
{
    protected $petRepository;

    public function __construct(PetRepository $petRepository)
    {
        $this->petRepository = $petRepository;
    }
    
/**
     * @OA\Get(
     *     path="/api/pet",
     *     summary="Obtener todas las mascotas",
     *     tags={"Pets"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de todas las mascotas",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Pet"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener las mascotas",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error fetching pet")
     *         )
     *     )
     * )
     */

    public function getAllPets(){
        try {
            $pet = $this->petRepository->all();

            return response()->json([
                'status' => true,
                'data' => $pet
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching pet',
                'error' => $th->getMessage()
            ], 500);
        }
    }

     /**
     * @OA\Get(
     *     path="/api/pet/{id}",
     *     summary="Obtener una mascota por ID",
     *     tags={"Pets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la mascota",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalles de la mascota",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Pet")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mascota no encontrada",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pet not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al obtener la mascota",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error fetching pet")
     *         )
     *     )
     * )
     */
    public function getPet($id){
        try {
            $pet = $this->petRepository->find($id);

            if (!$pet) {
                return response()->json([
                    'status' => false,
                    'message' => 'Pet not found'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $pet
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching pet',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/pet",
     *     summary="Crear una nueva mascota",
     *     tags={"Pets"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreatePetRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Mascota creada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Pet")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al crear la mascota",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error creating pet")
     *         )
     *     )
     * )
     */
    public function createPet(CreatePetRequest $request){
        try {
            $data = $request->validated();
            $pet = $this->petRepository->create($data);

            return response()->json([
                'status' => true,
                'data' => $pet
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating pet',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/pet/{id}",
     *     summary="Actualizar los datos de una mascota",
     *     tags={"Pets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la mascota",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdatePetRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mascota actualizada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Pet")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al actualizar la mascota",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error updating pet")
     *         )
     *     )
     * )
     */
    public function updatePet(UpdatePetRequest $request, $id){
        try {
            $data = $request->validated();

            $pet = $this->petRepository->update($id, $data);

            return response()->json([
                'status' => true,
                'data' => $pet
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating pet',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/pet/{id}",
     *     summary="Eliminar una mascota",
     *     tags={"Pets"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la mascota",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mascota eliminada exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Pet deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error al eliminar la mascota",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Error deleting pet")
     *         )
     *     )
     * )
     */
    public function deletePet($id){
        try {
            $this->petRepository->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Pet deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting pet',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
