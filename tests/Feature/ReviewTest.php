<?php

namespace Tests\Feature;

use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_review(): void
    {
        $this->seed();

        $review = Review::first();

        $response = $this->deleteJson('/api/review/'. $review->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('reviews', [
            'id' => $review->id
        ]);
    }

    public function test_delete_review_should_return_404_when_id_not_found(): void
    {
        $response = $this->deleteJson('/api/review/232323');

        $response->assertStatus(404);
    }
}
