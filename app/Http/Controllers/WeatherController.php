<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        $weatherData = [];

        foreach ($countries as $country) {

            $response = Http::withoutVerifying()->get(
                'https://api.openweathermap.org/data/2.5/weather',
                [
                    'q' => $country->name,
                    'appid' => config('services.openweather.key'),
                    'units' => 'metric',
                ]
            );

            if ($response->successful()) {

                $data = $response->json();

                $weatherData[] = [
                    'country'     => $country->name,
                    'temperature' => $data['main']['temp'],
                    'humidity'    => $data['main']['humidity'],
                    'wind'        => $data['wind']['speed'],
                    'condition'   => $data['weather'][0]['main'],
                ];
            }
        }

        return view('weather.index', compact('weatherData'));
    }
}