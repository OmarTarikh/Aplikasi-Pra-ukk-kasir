<?php

namespace App\Http\Controllers;

// Import Model Pelanggan
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PelangganController extends Controller
{
    /**
     * Display a listing of pelanggan.
     *
     * @return View
     */
    public function index(): View
    {
        // Get pelanggan data with pagination
        $pelanggan = Pelanggan::latest()->get();

        // Render view with pelanggan data
        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new pelanggan.
     *
     * @return View
     */
    public function create(): View
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created pelanggan in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate request data
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'NomorTelepon' => 'required|string|max:15|unique:pelanggan,NomorTelepon',
        ]);

        // Create pelanggan
        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified pelanggan.
     *
     * @param Pelanggan $pelanggan
     * @return View
     */
    public function edit(Pelanggan $pelanggan): View
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified pelanggan in storage.
     *
     * @param Request $request
     * @param Pelanggan $pelanggan
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'required|string',
            'NomorTelepon' => 'required|string|max:15|unique:pelanggan,NomorTelepon,' . $id . ',PelangganID',
        ]);
    
        // Find pelanggan by PelangganID
        $pelanggan = Pelanggan::where('PelangganID', $id)->firstOrFail();
    
        // Update pelanggan data
        $pelanggan->update($request->all());
    
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }
    
    /**
     * Remove the specified pelanggan from storage.
     *
     * @param Pelanggan $pelanggan
     * @return RedirectResponse
     */
    public function destroy(Pelanggan $pelanggan): RedirectResponse
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
