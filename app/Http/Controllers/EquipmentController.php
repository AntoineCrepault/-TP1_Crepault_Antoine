<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Resources\EquipmentResource;
use App\Models\Rental;
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

         $averageRating = Review::select('reviews.rating')
            ->join('rentals', 'reviews.rental_id', '=', 'rentals.id')
            ->where('rentals.equipment_id', $equipment->id)
            ->avg('reviews.rating');

         if (is_null($averageRating)) {
            $averageRating = 0;
         }

         $popularity = round(($rentalCount * 0.6) + ($averageRating * 0.4), 2);

         return response()->json(['popularity' => $popularity,])->setStatusCode(200);
      } catch (ModelNotFoundException $ex) {
         abort(404, 'invalid ID');
      } catch (Exception $ex) {
         abort(500, 'Server Error');
      } 
        
   }


   public function showAverageTotalCost(Request $request, string $id)
   {
      try {
         $equipment = Equipment::findOrFail($id);

         $request->validate([
           'minDate' => 'nullable|date',                        //https://laravel.com/docs/12.x/validation#a-note-on-optional-fields
           'maxDate' => 'nullable|date|after_or_equal:minDate', //https://laravel.com/docs/12.x/validation#rule-after-or-equal
         ]);

         $minDate = $request->input('minDate');
         $maxDate = $request->input('maxDate');

         $equipment_rentals = Rental::where('equipment_id', $equipment->id);

         switch (true) {
            case ($minDate && $maxDate):
               $equipment_rentals->whereBetween('start_date', [$minDate, $maxDate]);
               break;

            case ($minDate):
               $equipment_rentals->where('start_date', '>=', $minDate);
               break;

            case ($maxDate):
               $equipment_rentals->where('start_date', '<=', $maxDate);
               break;
         }

        $averageTotalCost = round($equipment_rentals->avg('total_price') ?? 0, 2);

         return response()->json([
            'averageTotalCost' => $averageTotalCost
         ], 200);

      } catch (ModelNotFoundException $ex) {
         abort(404, 'invalid ID');
      } catch (Exception $ex) {
         abort(500, 'Server Error');
      }
   }
}
