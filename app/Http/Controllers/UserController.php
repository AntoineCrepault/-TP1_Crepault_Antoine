<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


use OpenApi\Attributes as OA;

class UserController
{

//store + swagger

    #[OA\Post(
        path: "/api/user",
        summary: "Créer un utilisateur",
        tags: ["Users"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "firstname", type: "string", example: "Antoine"),
                    new OA\Property(property: "lastname", type: "string", example: "Crépault"),
                    new OA\Property(property: "email", type: "string", example: "antoine@gmail.com"),
                    new OA\Property(property: "phone", type: "string", example: "4182535187")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: "Utilisateur créé"),
            new OA\Response(response: 422, description: "Données invalides")
        ]
    )]
    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            return (new UserResource($user))->response()->setStatusCode(201);
        } catch (QueryException $ex) {
            abort(422, 'invalid data');
        } catch (Exception $ex) {
            abort(500, 'Server error');
        }
    }


//update + swagger

    #[OA\Post(
        path: "/api/user/{id}",
        summary: "Modifier un utilisateur",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "User ID",
                in: "path",
                required: true
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "firstname", type: "string", example: "Antoine"),
                    new OA\Property(property: "lastname", type: "string", example: "Crépault"),
                    new OA\Property(property: "email", type: "string", example: "antoine@gmail.com"),
                    new OA\Property(property: "phone", type: "string", example: "4182535187")
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: "Utilisateur a été modifié"),
            new OA\Response(response: 404, description: "ID invalide"),
            new OA\Response(response: 422, description: "Données invalides")
        ]
    )]

    public function update(StoreUserRequest $request, string $id)
    {
        try{
            $user = User::findOrFail($id);
            $user->update($request->validated());
            return (new UserResource($user))->response()->setStatusCode(200);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'invalid ID');

        } catch (QueryException $ex) {
            abort(422, 'not found');

        } catch (Exception $ex) {
            abort(500, 'Server error');
        }
    }
}
