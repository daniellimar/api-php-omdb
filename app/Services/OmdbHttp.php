<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

class OmdbHttp
{
    public static function get(string $endpoint, array $params = [])
    {
        $baseUrl = 'https://www.omdbapi.com/';
        $params['apikey'] = config('services.omdb.key');

        $http = Http::withOptions([
            'verify' => !App::environment('local')
        ]);

        return $http->get($baseUrl . $endpoint, $params);
    }
}
