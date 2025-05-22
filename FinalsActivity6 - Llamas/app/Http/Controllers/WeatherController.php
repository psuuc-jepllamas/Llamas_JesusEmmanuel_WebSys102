<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $defaultCity = $request->query('city', 'London');
        $apiKey = env('OPENWEATHER_API_KEY');
        
        $cities = [$defaultCity, 'Singapore', 'Dubai'];
        $weatherData = [];

        foreach ($cities as $city) {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $weatherData[] = [
                    'city' => $city,
                    'temperature' => $response['main']['temp'],
                    'description' => $response['weather'][0]['description'],
                    'humidity' => $response['main']['humidity'],
                ];
            } else {
                $weatherData[] = [
                    'city' => $city,
                    'error' => 'Could not fetch weather data',
                ];
            }
        }

        return response()->json($weatherData);
    }
}