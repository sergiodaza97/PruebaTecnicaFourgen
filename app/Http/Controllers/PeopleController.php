<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Repositories\PeopleRepository;
use Illuminate\Http\Request;
/**
* @OA\Info(
*             title="API Personas", 
*             version="1.0",
*             description="Mostando la Lista de URI's de mi API"
* )
*
* @OA\Server(url="http://PruebaTecnicaFourgen.test")
*/
class PeopleController extends Controller
{
    protected $peopleRepository;

    public function __construct(PeopleRepository $peopleRepository)
    {
        $this->peopleRepository = $peopleRepository;
    }
    /**
     * Mostrar Lista de Personas
     * @OA\Get (
     *     path="/api/person",
     *     tags={"Personas"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Sergio Daza"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="sergioandres.daza.1103@gmail.com"
     *                     ),
     *                     @OA\Property(
     *                         property="bithday",
     *                         type="string",
     *                         example="sergioandres.daza.1103@gmail.com"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function getAllPerson(){
        try {
            $people = $this->peopleRepository->all();

            return response()->json([
                'status' => true,
                'data' => $people
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching people',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar Una Persona
     * @OA\Get (
     *     path="/api/person/{id}",
     *     tags={"Personas"},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Sergio Daza"
     *                     ),
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="sergioandres.daza.1103@gmail.com"
     *                     ),
     *                     @OA\Property(
     *                         property="bithday",
     *                         type="string",
     *                         example="sergioandres.daza.1103@gmail.com"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function getPerson($id){
        try {
            $person = $this->peopleRepository->find($id);

            if (!$person) {
                return response()->json([
                    'status' => false,
                    'message' => 'Person not found'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $person
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching person',
                'error' => $th->getMessage()
            ], 500);
        }
    }

     /**
     * Registrar la información de una Persona
     * @OA\Post (
     *     path="/api/person",
     *     tags={"Personas"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="birthday",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Sergio Daza",
     *                     "email":"sergioandres.daza.1103@gmail.com",
     *                     "birthday":"1997-11-25"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="CREATED",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Sergio Daza"),
     *              @OA\Property(property="email", type="string", example="sergioandres.daza.1103@gmail.com"),
     *              @OA\Property(property="birthday", type="string", example="1997-11-25"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="UNPROCESSABLE CONTENT",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Error creating person"),
     *              @OA\Property(property="errors", type="string", example="Objeto de errores"),
     *          )
     *      )
     * )
     */
    public function createPerson(StorePersonRequest $request){
        try {
            $data = $request->validated();
            $person = $this->peopleRepository->create($data);

            return response()->json([
                'status' => true,
                'data' => $person
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating person',
                'error' => $th->getMessage()
            ], 500);
        }
    }

        /**
     * Actualizar información de una Persona
     * @OA\Put (
     *     path="/api/person/{id}",
     *     tags={"Personas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="email", type="string"),
     *                 @OA\Property(property="birthday", type="string")
     *             ),
     *             example={
     *                 "name": "Sergio Daza",
     *                 "email": "sergioandres.daza.1103@gmail.com",
     *                 "birthday": "1997-11-25"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error updating person",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Error updating person"),
     *             @OA\Property(property="error", type="string", example="Exception message here")
     *         )
     *     )
     * )
     */

    public function updatePerson(UpdatePersonRequest $request, $id){
        try {
            $data = $request->validated();

            $person = $this->peopleRepository->update($id, $data);

            return response()->json([
                'status' => true,
                'data' => $person
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error updating person',
                'error' => $th->getMessage()
            ], 500);
        }
    }

        /**
     * Eliminar una Persona
     * @OA\Delete (
     *     path="/api/person/{id}",
     *     tags={"Personas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Person deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Person deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Error deleting person",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Error deleting person"),
     *             @OA\Property(property="error", type="string", example="Exception message")
     *         )
     *     )
     * )
     */
    public function deletePerson($id){
        try {
            $this->peopleRepository->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Person deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error deleting person',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
 * Mostrar Persona con sus Mascotas
 * @OA\Get (
 *     path="/api/person/{id}/pets",
 *     tags={"Personas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=true),
 *             @OA\Property(property="data", type="object")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Person not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Person not found")
 *         )
 *     )
 * )
 */

    public function getPersonWithPets($id){
        try {
            $person = $this->peopleRepository->findWithPets($id);

            if (!$person) {
                return response()->json([
                    'status' => false,
                    'message' => 'Person not found'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $person
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error fetching person with pets',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
