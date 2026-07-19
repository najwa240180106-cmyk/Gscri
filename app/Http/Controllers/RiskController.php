<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\RedirectResponse;

class RiskController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();

        return view('risk.index', compact('countries'));
    }

    public function updateApi(): RedirectResponse
    {
        $countries = Country::all();

        foreach ($countries as $country) {

            $score = 0;

            // GDP
            if (($country->gdp ?? 0) < 3) {
                $score++;
            }

            // Inflation
            if (($country->inflation ?? 0) > 5) {
                $score++;
            }

            // Weather
            $weather = strtolower($country->weather ?? '');

            if (
                str_contains($weather, 'rain') ||
                str_contains($weather, 'storm') ||
                str_contains($weather, 'thunder')
            ) {
                $score++;
            }

            // Risk Level
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

        return redirect()
            ->route('risk.index')
            ->with('success', 'Risk analysis updated successfully.');
    }
}