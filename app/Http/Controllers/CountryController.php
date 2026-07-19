<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    /**
     * Menampilkan daftar negara
     */
    public function index()
    {
        $countries = Country::orderBy('name')->get();

        return view('countries.index', compact('countries'));
    }
    public function show(Country $country)
{
    return view('countries.show', compact('country'));
}

    /**
     * Import negara dari API Ninjas
     */
    public function import(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        // API Ninjas
        $response = Http::withoutVerifying()
            ->withHeaders([
                'X-Api-Key' => config('services.apininjas.key'),
            ])
            ->get('https://api.api-ninjas.com/v1/country', [
                'name' => $request->name,
            ]);

        if (!$response->successful() || empty($response->json())) {
            return back()->with('error', 'Negara tidak ditemukan.');
        }

        $item = $response->json()[0];

        // OpenStreetMap
        $location = Http::withoutVerifying()
            ->withHeaders([
                'User-Agent' => 'GSCRI Laravel App',
            ])
            ->get('https://nominatim.openstreetmap.org/search', [
                'q'      => $item['name'],
                'format' => 'json',
                'limit'  => 1,
            ]);

        $geo = $location->json();

        // Simpan Country
        $country = Country::updateOrCreate(
            [
                'country_code' => $item['iso2'],
            ],
            [
                'name'       => $item['name'],
                'currency'   => $item['currency']['code']
                                ?? $item['currency']['name']
                                ?? null,
                'region'     => $item['region'] ?? null,

                'gdp'        => 0,
                'inflation'  => 0,
                'weather'    => '-',
                'risk'       => 'LOW',
                'port'       => '-',

                'latitude'   => $geo[0]['lat'] ?? 0,
                'longitude'  => $geo[0]['lon'] ?? 0,
            ]
        );

        // Mapping ISO2 -> ISO3 (World Bank)
        $mapping = [
            'ID' => 'IDN',
            'JP' => 'JPN',
            'CN' => 'CHN',
            'SG' => 'SGP',
            'MY' => 'MYS',
            'KR' => 'KOR',
            'TH' => 'THA',
            'VN' => 'VNM',
            'US' => 'USA',
        ];

        $code = $mapping[$country->country_code] ?? null;

        if ($code) {

            // GDP
            $gdp = Http::withoutVerifying()->get(
                "https://api.worldbank.org/v2/country/{$code}/indicator/NY.GDP.MKTP.KD.ZG?format=json"
            );

            // Inflation
            $inflation = Http::withoutVerifying()->get(
                "https://api.worldbank.org/v2/country/{$code}/indicator/FP.CPI.TOTL.ZG?format=json"
            );

            $country->gdp = $gdp->json()[1][0]['value'] ?? 0;
            $country->inflation = $inflation->json()[1][0]['value'] ?? 0;

            $country->save();
        }

        return redirect()
            ->route('countries.index')
            ->with('success', $country->name . ' berhasil diimport.');
    }
}