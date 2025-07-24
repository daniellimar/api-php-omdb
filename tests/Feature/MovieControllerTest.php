<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Movie;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_paginated_list_of_movies()
    {
        Movie::factory()->count(15)->create();

        $response = $this->getJson('/api/movies');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => ['id', 'title', 'year', 'director', 'created_at', 'updated_at']
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }

    /** @test */
    public function it_filters_movies_by_title()
    {
        Movie::factory()->create(['title' => 'Matrix']);
        Movie::factory()->create(['title' => 'Batman']);

        $response = $this->getJson('/api/movies?title=Matrix');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['title' => 'Matrix']);
    }

    /** @test */
    public function it_returns_single_movie_by_id()
    {
        $movie = Movie::factory()->create();

        $response = $this->getJson("/api/movies/{$movie->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $movie->id,
                    'title' => $movie->title,
                    'year' => $movie->year,
                    'director' => $movie->director,
                ],
            ]);
    }

    /** @test */
    public function it_returns_validation_error_if_movie_not_found()
    {
        $response = $this->getJson('/api/movies/9999');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['id'])
            ->assertJsonFragment([
                'id' => ['O ID do filme informado não existe.'],
            ]);
    }
}
