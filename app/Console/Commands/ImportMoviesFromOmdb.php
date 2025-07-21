<?php

namespace App\Console\Commands;

use App\Services\OmdbHttp;
use Illuminate\Console\Command;
use App\Models\Movie;

class ImportMoviesFromOmdb extends Command
{
    protected $signature = 'omdb:search {term}';
    protected $description = 'Busca e importa filmes da API OMDb com base em um termo de pesquisa';

    public function handle(): void
    {
        $term = $this->argument('term');
        $this->info("🔍 Buscando filmes com o termo: '{$term}'");

        $searchResponse = OmdbHttp::get('', [
            's' => $term,
            'type' => 'movie',
        ]);

        if ($searchResponse->failed() || $searchResponse['Response'] === 'False') {
            $this->error("❌ Nenhum resultado encontrado ou erro na busca.");
            return;
        }

        $searchResults = $searchResponse['Search'];

        foreach ($searchResults as $item) {
            $imdbID = $item['imdbID'];

            $movieResponse = OmdbHttp::get('', [
                'i' => $imdbID,
                'plot' => 'full',
            ]);

            if ($movieResponse->failed() || $movieResponse['Response'] === 'False') {
                $this->warn("⚠️ Não foi possível buscar detalhes para: {$imdbID}");
                continue;
            }

            $data = $movieResponse->json();

            Movie::updateOrCreate(
                ['imdb_id' => $data['imdbID']],
                array_filter([
                    'title' => $data['Title'] ?? null,
                    'year' => $data['Year'] ?? null,
                    'rated' => $data['Rated'] ?? null,
                    'released' => $data['Released'] ?? null,
                    'runtime' => $data['Runtime'] ?? null,
                    'genre' => $data['Genre'] ?? null,
                    'director' => $data['Director'] ?? null,
                    'writer' => $data['Writer'] ?? null,
                    'actors' => $data['Actors'] ?? null,
                    'plot' => $data['Plot'] ?? null,
                    'language' => $data['Language'] ?? null,
                    'country' => $data['Country'] ?? null,
                    'awards' => $data['Awards'] ?? null,
                    'poster' => $data['Poster'] ?? null,
                    'ratings' => $data['Ratings'] ?? null,
                    'metascore' => $data['Metascore'] ?? null,
                    'imdb_rating' => $data['imdbRating'] ?? null,
                    'imdb_votes' => $data['imdbVotes'] ?? null,
                    'type' => $data['Type'] ?? null,
                    'dvd' => $data['DVD'] ?? null,
                    'box_office' => $data['BoxOffice'] ?? null,
                    'production' => $data['Production'] ?? null,
                    'website' => $data['Website'] ?? null,
                ])
            );

            $this->info("✅ Filme '{$data['Title']}' importado com sucesso.");
        }

        $this->info("🏁 Importação finalizada.");
    }
}
