<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PortController extends Controller
{
    /**
     * Menampilkan semua port
     */
    public function index()
    {
        $ports = Port::with('country')
            ->latest()
            ->paginate(10);

        return view('ports.index', compact('ports'));
    }

    /**
     * Import Port dari GeoNames
     */
    public function import(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $response = Http::get('http://api.geonames.org/searchJSON', [
            'q'        => $request->name,
            'maxRows'  => 1,
            'username' => config('services.geonames.username'),
        ]);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal mengambil data dari GeoNames.');
        }

        $result = $response->json()['geonames'] ?? [];

        if (empty($result)) {
            return back()->with('error', 'Port tidak ditemukan.');
        }

        $geoPort = $result[0];

        // Cari negara berdasarkan country_code
        $country = Country::where(
            'country_code',
            $geoPort['countryCode']
        )->first();

        if (!$country) {
            return back()->with(
                'error',
                'Negara belum ada. Silakan import negara terlebih dahulu.'
            );
        }

        Port::updateOrCreate(
            [
                'country_id' => $country->id,
                'name'       => $geoPort['name'],
            ],
            [
                'status'    => 'Active',
                'capacity'  => $geoPort['population'] ?? 0,
                'risk'      => 'LOW',
                'latitude'  => $geoPort['lat'],
                'longitude' => $geoPort['lng'],
            ]
        );

        return redirect()
            ->route('ports.index')
            ->with('success', 'Port berhasil diimport.');
    }

    /**
     * Form tambah port manual
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();

        return view('ports.create', compact('countries'));
    }

    /**
     * Simpan port manual
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name'       => 'required',
            'status'     => 'required',
            'capacity'   => 'required',
            'risk'       => 'required',
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);

        Port::create($validated);

        return redirect()
            ->route('ports.index')
            ->with('success', 'Port berhasil ditambahkan.');
    }

    /**
     * Form edit port
     */
    public function edit(Port $port)
    {
        $countries = Country::orderBy('name')->get();

        return view('ports.edit', compact('port', 'countries'));
    }

    /**
     * Update port
     */
    public function update(Request $request, Port $port)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name'       => 'required',
            'status'     => 'required',
            'capacity'   => 'required',
            'risk'       => 'required',
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);

        $port->update($validated);

        return redirect()
            ->route('ports.index')
            ->with('success', 'Port berhasil diperbarui.');
    }

    /**
     * Hapus port
     */
    public function destroy(Port $port)
    {
        $port->delete();

        return redirect()
            ->route('ports.index')
            ->with('success', 'Port berhasil dihapus.');
    }
}