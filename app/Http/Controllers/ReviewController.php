<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ReviewController
{
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
