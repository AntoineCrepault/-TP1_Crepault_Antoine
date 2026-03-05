<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use App\Models\Review;
use App\Http\Resources\EquipmentResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class EquipmentController
{
    public function index()
    {
        try {
            return EquipmentResource::collection(Equipment::paginate(10))->response()->setStatusCode(200);
        } catch (Exception $ex) {
           abort(500, 'Server Error');
        }
    }

    public function show(string $id)
    {
     try {
        return (new EquipmentResource(Equipment::findOrFail($id)))->response()->setStatusCode(200);
     } catch (ModelNotFoundException $ex) {
        abort(404, 'invalid ID');
     } catch (Exception $ex) {
        abort(500, 'Server Error');
     } 
        
    }

    public function showPopularity(string $id)
    {
     try {
        $equipment = Equipment::findOrFail($id);

        $rentalCount = $equipment->rental()->count();

        $averageRating = Review::select(DB::raw('AVG(rating) as average_rating'))
            ->join('rentals', 'reviews.rental_id', '=', 'rentals.id')
            ->where('rentals.equipment_id', $equipment->id)
            ->avg('reviews.rating');
        if (is_null($averageRating)) {
            $averageRating = 0;
        }

        $popularityIndex = round(($rentalCount * 0.6) + ($averageRating * 0.4), 2);

        return response()->json(['popularity_index' => $popularityIndex,])->setStatusCode(200);
     } catch (ModelNotFoundException $ex) {
        abort(404, 'invalid ID');
     } catch (Exception $ex) {
        abort(500, 'Server Error');
     } 
        
    }



    
}
