<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Port;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // Semua negara (untuk map)
        $countries = Country::orderBy('name')->get();

        // Data cuaca (5 negara)
        $weatherCountries = Country::orderBy('name')
            ->take(5)
            ->get();

        // Statistik
        $totalCountries = Country::count();
        $totalPorts = Port::count();

        $lowRisk = Country::where('risk', 'LOW')->count();
        $mediumRisk = Country::where('risk', 'MEDIUM')->count();
        $highRisk = Country::where('risk', 'HIGH')->count();

        // Ekonomi
        $avgGdp = Country::avg('gdp');
        $avgInflation = Country::avg('inflation');

        // News API
        $response = Http::withoutVerifying()->get(
            'https://newsapi.org/v2/everything',
            [
                'q' => 'global supply chain',
                'language' => 'en',
                'sortBy' => 'publishedAt',
                'pageSize' => 3,
                'apiKey' => config('services.newsapi.key'),
            ]
        );

        $news = $response->json()['articles'] ?? [];

        // Waktu terakhir data Country diperbarui
        $lastUpdate = Country::max('updated_at');

        return view('dashboard', compact(
            'countries',
            'weatherCountries',
            'totalCountries',
            'totalPorts',
            'lowRisk',
            'mediumRisk',
            'highRisk',
            'avgGdp',
            'avgInflation',
            'news',
            'lastUpdate'
        ));
    }
}