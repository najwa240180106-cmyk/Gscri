<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    /**
     * Menampilkan daftar negara dari database
     */
    public function index()
    {
        $countries = Country::orderBy('name')->get();

        return view('countries.index', compact('countries'));
    }

    /**
     * Import negara dari API Ninjas
     */
public function import(Request $request)
{
    $request->validate([
        'name' => 'required|string',
    ]);

    // Ambil data negara dari API Ninjas
    $response = Http::withoutVerifying()
        ->withHeaders([
            'X-Api-Key' => config('services.apininjas.key'),
        ])
        ->get('https://api.api-ninjas.com/v1/country', [
            'name' => $request->name,
        ]);

    if (!$response->successful() || empty($response->json())) {
        return redirect()->back()->with('error', 'Negara tidak ditemukan.');
    }

    $item = $response->json()[0];
   

    // Ambil koordinat dari OpenStreetMap
    $location = Http::withoutVerifying()
        ->withHeaders([
            'User-Agent' => 'GSCRI Laravel App',
        ])
        ->get('https://nominatim.openstreetmap.org/search', [
            'q' => $item['name'],
            'format' => 'json',
            'limit' => 1,
        ]);

    $geo = $location->json();

    Country::updateOrCreate(
        [
            'country_code' => $item['iso2'],
        ],
        [
            'name'          => $item['name'],
            'currency' => $item['currency']['code']
    ?? $item['currency']['name']
    ?? null,
            'region'        => $item['region'] ?? null,

            'gdp'           => 0,
            'inflation'     => 0,
            'weather'       => '-',
            'risk'          => 'LOW',
            'port'          => '-',

            'latitude'      => $geo[0]['lat'] ?? 0,
            'longitude'     => $geo[0]['lon'] ?? 0,
        ]
    );

    return redirect()
        ->route('countries.index')
        ->with('success', $item['name'].' berhasil diimport.');
    }
}