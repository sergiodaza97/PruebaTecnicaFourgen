<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Usuarios",
 *     description="Operaciones relacionadas con usuarios"
 * )
 */
class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

        /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Obtener todos los usuarios",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuarios obtenida exitosamente"
     *     )
     * )
     */
    public function getAllUsers()
    {
        try {
            $user = $this->userRepository->all();

            return response()->json([
                'status' => true,
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching user',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Obtener el usuario autenticado",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Usuario autenticado obtenido exitosamente"
     *     )
     * )
     */
    public function getUser()
    {
        try {
            $id = Auth::id();
            $user = $this->userRepository->find($id);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'user not found'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching user',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     summary="Crear un nuevo usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuario creado exitosamente"
     *     )
     * )
     */
    public function createUser(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $this->userRepository->create($data);

            return response()->json([
                'status' => true,
                'data' => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating user',
                'error' => $th->getMessage()
            ], 500);
        }
    }

        /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     summary="Actualizar un usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del usuario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario actualizado correctamente"
     *     )
     * )
     */

    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $user = $this->userRepository->update($id, $data);

            return response()->json([
                'status' => true,
                'data' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating user',
                'error' => $th->getMessage()
            ], 500);
        }
    }

        /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     summary="Eliminar un usuario",
     *     tags={"Usuarios"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del usuario a eliminar",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuario eliminado exitosamente"
     *     )
     * )
     */
    public function deleteUser($id)
    {
        try {
            $this->userRepository->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting User',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
