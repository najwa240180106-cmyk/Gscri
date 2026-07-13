<?php

namespace App\Http\Controllers;

use App\Models\Country;

class RiskController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        foreach ($countries as $country) {

            $score = 0;

            // GDP
            if ($country->gdp < 3) {
                $score++;
            }

            // Inflation
            if ($country->inflation > 5) {
                $score++;
            }

            // Weather
            if (
                str_contains(strtolower($country->weather), 'rain') ||
                str_contains(strtolower($country->weather), 'storm')
            ) {
                $score++;
            }

            // Tentukan Risk
            if ($score >= 3) {
                $country->risk = 'HIGH';
            } elseif ($score == 2) {
                $country->risk = 'MEDIUM';
            } else {
                $country->risk = 'LOW';
            }

            $country->score = $score;

            $country->save();
        }

        return view('risk.index', compact('countries'));
    }
}
