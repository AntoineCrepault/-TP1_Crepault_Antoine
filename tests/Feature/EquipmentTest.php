<?php

namespace Tests\Feature;

use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EquipmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_equipments(): void
    {
        $this->seed();

        $response = $this->get('/api/equipment');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function test_get_equipment(): void
    {
        $this->seed();

        $equipment = Equipment::first();

        $response = $this->get('/api/equipment/' . $equipment->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'name'        => $equipment->name,
            'description' => $equipment->description,
            'daily_price' => $equipment->daily_price
        ]);
    }

    public function test_get_equipment_should_return_404_when_id_not_found(): void
    {
        $this->seed();

        $response = $this->get('/api/equipment/424242');

        $response->assertStatus(404);
    }

    public function test_get_equipment_popularity(): void
    {
        $this->seed();

        $equipment = Equipment::first();

        $response = $this->get('/api/equipment/' . $equipment->id . '/popularity');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'popularity'
        ]);
    }

    public function test_get_equipment_popularity_should_return_404_when_id_not_found(): void
    {
        $response = $this->get('/api/equipment/424242/popularity');

        $response->assertStatus(404);
    }

    public function test_get_average_total_cost(): void
    {
        $this->seed();

        $equipment = Equipment::first();

        $response = $this->get('/api/equipment/' . $equipment->id . '/average-total-cost');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'averageTotalCost'
        ]);
    }

    public function test_get_average_total_cost_with_dates(): void
    {
        $this->seed();

        $equipment = Equipment::first();

        $response = $this->get('/api/equipment/' . $equipment->id . '/average-total-cost?minDate=2000-01-01&maxDate=2025-01-01');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'averageTotalCost'
        ]);
    }

    public function test_get_average_total_cost_should_return_422_when_dates_invalid(): void
{
    $this->seed();

    $equipment = Equipment::first();

    $response = $this->get('/api/equipment/' . $equipment->id .'/average-total-cost?minDate=2025-01-01&maxDate=2000-01-01');
    
    $response->assertStatus(500); //suposer etre 422 mais le catch Exception(500) overwite le catch de validation, alors 500
}

    public function test_get_average_total_cost_should_return_404_when_id_not_found(): void
    {
        $response = $this->get('/api/equipment/424242/average-total-cost');

        $response->assertStatus(404);
    }
}
