<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class UserController
{
     public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            return (new UserResource($user))->response()->setStatusCode(201);
        } catch (QueryException $ex) {
            abort(422, 'Cannot be created in database');
        } catch (Exception $ex) {
            abort(500, 'Server error');
        }
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return response()->noContent();
        } catch (QueryException $ex) {
            abort(422, 'not found');
        } catch (Exception $ex) {
            abort(500, 'Server error');
        }
    }

    public function update(StoreUserRequest $request, string $id)
    {
        try{
            $user = User::findOrFail($id);
            $user->update($request->validated());
            return (new UserResource($user))->response()->setStatusCode(200);
        } catch (QueryException $ex) {
            abort(422, 'not found');
        } catch (Exception $ex) {
            abort(500, 'Server error');
        }
    }
}
