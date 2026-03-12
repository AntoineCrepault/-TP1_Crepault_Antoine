<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

use OpenApi\Attributes as OA;

class ReviewController
{

//destroy + swagger

    #[OA\Delete(
        path: "/api/review/{id}",
        summary: "Supprimer un review",
        tags: ["Reviews"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Review ID",
                in: "path",
                required: true
            )
        ],
        responses: [
            new OA\Response(response: 204, description: "Review a été supprimée"),
            new OA\Response(response: 404, description: "ID invalide"),
            new OA\Response(response: 422, description: "Données invalides")
        ]
    )]
    public function destroy($id)
    {
        try{
            $review = Review::findOrFail($id);
            $review->delete();
            return response()->noContent()->setStatusCode(204);
        } catch (ModelNotFoundException $ex) {
            abort(404, 'invalid ID');

        } catch (QueryException $ex) {
            abort(422, 'not found');

        } catch (Exception $ex) {
            abort(500, 'Server error');
        }
    }
}
