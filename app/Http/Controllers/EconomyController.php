<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;

class EconomyController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();

        return view('economy.index', compact('countries'));
    }

    public function updateApi(): RedirectResponse
    {
        $countries = Country::all();

        $iso3Map = [
            'ID' => 'IDN',
            'JP' => 'JPN',
            'CN' => 'CHN',
            'SG' => 'SGP',
            'MY' => 'MYS',
        ];

        foreach ($countries as $country) {

            $iso3 = $iso3Map[$country->country_code] ?? null;

            if (!$iso3) {
                continue;
            }

            // GDP Growth
           $gdp = Http::withoutVerifying()->get(
        "https://api.worldbank.org/v2/country/{$iso3}/indicator/NY.GDP.MKTP.KD.ZG?format=json"
);
            if (
                $gdp->successful() &&
                isset($gdp->json()[1][0]['value']) &&
                $gdp->json()[1][0]['value'] !== null
            ) {
                $country->gdp = $gdp->json()[1][0]['value'];
            }

           
            // Inflation
$inflation = Http::withoutVerifying()->get(
    "https://api.worldbank.org/v2/country/{$iso3}/indicator/FP.CPI.TOTL.ZG?format=json"
);
            if (
                $inflation->successful() &&
                isset($inflation->json()[1][0]['value']) &&
                $inflation->json()[1][0]['value'] !== null
            ) {
                $country->inflation = $inflation->json()[1][0]['value'];
            }

            $country->save();
        }

        return redirect()
            ->route('economy.index')
            ->with('success', 'Economy data updated successfully.');
    }
}