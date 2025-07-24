<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = \App\Models\Movie::class;

    public function definition()
    {
        return [
            'imdb_id' => $this->faker->unique()->regexify('tt\d{7}'), // Ex: tt1234567
            'title' => $this->faker->sentence(3),
            'year' => $this->faker->year(),
            'rated' => $this->faker->randomElement(['G', 'PG', 'PG-13', 'R', 'NC-17']),
            'released' => $this->faker->date('d M Y'), // formato: 04 May 2012
            'runtime' => $this->faker->randomElement(['90 min', '120 min', '143 min']),
            'genre' => $this->faker->randomElement(['Action, Sci-Fi', 'Drama', 'Comedy']),
            'director' => $this->faker->name(),
            'writer' => $this->faker->name(),
            'actors' => $this->faker->name() . ', ' . $this->faker->name() . ', ' . $this->faker->name(),
            'plot' => $this->faker->paragraph(),
            'language' => $this->faker->randomElement(['English', 'English, Russian', 'French']),
            'country' => $this->faker->country(),
            'awards' => $this->faker->sentence(5),
            'poster' => $this->faker->imageUrl(300, 450, 'movies', true, 'Faker'),
            'ratings' => json_encode([
                ['Source' => 'Internet Movie Database', 'Value' => $this->faker->randomFloat(1, 1, 10) . '/10'],
                ['Source' => 'Rotten Tomatoes', 'Value' => $this->faker->numberBetween(40, 100) . '%'],
                ['Source' => 'Metacritic', 'Value' => $this->faker->numberBetween(40, 100) . '/100'],
            ]),
            'metascore' => $this->faker->numberBetween(40, 100),
            'imdb_rating' => (string)$this->faker->randomFloat(1, 1, 10),
            'imdb_votes' => number_format($this->faker->numberBetween(1000, 2000000)),
            'type' => 'movie',
            'dvd' => $this->faker->optional()->date('d M Y'),
            'box_office' => $this->faker->optional()->randomElement(['$100,000', '$500,000', '$1,000,000']),
            'production' => $this->faker->company(),
            'website' => $this->faker->optional()->url(),
        ];
    }
}
