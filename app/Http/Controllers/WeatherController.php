<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();

        return view('weather.index', compact('countries'));
    }

    public function updateApi(): RedirectResponse
    {
        $countries = Country::all();

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

                $country->weather = $data['weather'][0]['main'];
                $country->save();
            }
        }

        return redirect()
            ->route('weather.index')
            ->with('success', 'Weather data updated successfully.');
    }
}