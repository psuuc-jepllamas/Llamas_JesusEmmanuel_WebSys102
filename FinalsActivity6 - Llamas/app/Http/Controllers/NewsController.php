<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function getNews()
    {
        $news = Cache::remember('tech_news', 3600, function () {
            $response = Http::get('https://newsapi.org/v2/top-headlines', [
                'apiKey' => env('NEWSAPI_KEY'),
                'country' => 'us',
                'category' => 'technology',
            ]);

            if ($response->failed() || $response->json()['status'] !== 'ok') {
                return ['error' => 'Failed to fetch news from NewsAPI'];
            }

            return $response->json();
        });

        if (isset($news['error'])) {
            return response()->json(['error' => $news['error']], 500);
        }

        return response()->json($news);
    }
}