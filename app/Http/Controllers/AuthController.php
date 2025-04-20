<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\LoginRepositoryInterface;

/**
 * @OA\Tag(
 *     name="Autenticación",
 *     description="Operaciones de inicio de sesión y autenticación con JWT"
 * )
 */
class AuthController extends Controller
{
    protected $auth;

    public function __construct(LoginRepositoryInterface $auth)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->auth = $auth;
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Iniciar sesión y obtener token",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string", example="bearer"),
     *             @OA\Property(property="expires_in", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="No autorizado"
     *     )
     * )
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        $token = $this->auth->login($credentials);

        if (! $token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *     path="/api/me",
     *     summary="Obtener el usuario autenticado",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Información del usuario",
     *         @OA\JsonContent(type="object")
     *     )
     * )
     */
    public function me()
    {
        return response()->json($this->auth->getAuthenticatedUser());
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Cerrar sesión",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Cierre de sesión exitoso",
     *         @OA\JsonContent(
     *             @OA\Property(property="mensaje", type="string", example="Cierre de sesión exitoso")
     *         )
     *     )
     * )
     */
    public function logout()
    {
        $this->auth->logout();
        return response()->json(['mensaje' => 'Cierre de sesión exitoso']);
    }

     /**
     * @OA\Post(
     *     path="/api/refresh",
     *     summary="Refrescar token JWT",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Nuevo token generado",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string"),
     *             @OA\Property(property="token_type", type="string", example="bearer"),
     *             @OA\Property(property="expires_in", type="integer")
     *         )
     *     )
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken($this->auth->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}