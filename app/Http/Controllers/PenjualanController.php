<?php

namespace App\Http\Controllers;

// Import Model Penjualan
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PenjualanController extends Controller
{
    /**
     * Display a listing of penjualan.
     *
     * @return View
     */
    public function index(): View
    {
        $penjualan = Penjualan::with('pelanggan')->latest()->get();
        $pelanggan = Pelanggan::all();
        return view('penjualan.index', compact('penjualan', 'pelanggan'));
    }
    
        
    /**
     * Show the form for creating a new penjualan.
     *
     * @return View
     */
    public function create(): View
    {
        // Fetch pelanggan for the dropdown selection
        $pelanggan = Pelanggan::all();

        return view('penjualan.create', compact('pelanggan'));
    }

    /**
     * Store a newly created penjualan in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'TanggalPenjualan' => 'required|date',
            'PelangganID' => 'required|exists:pelanggan,PelangganID',
        ]);
    
        // Create the new Penjualan record with TotalHarga set to 0
        $penjualan = Penjualan::create([
            'TanggalPenjualan' => $validated['TanggalPenjualan'],
            'TotalHarga' => 0, // Default value
            'PelangganID' => $validated['PelangganID'],
        ]);
    
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }
    
    /**
     * Show the details of a specific penjualan.
     *
     * @param int $id
     * @return View
     */
    public function show($id): View
    {
        // Get the specific penjualan record along with pelanggan details
        $penjualan = Penjualan::with('pelanggan')->where('PenjualanID', $id)->firstOrFail();

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified penjualan.
     *
     * @param int $id
     * @return View
     */
    public function edit($id): View
    {
        // Get the penjualan record
        $penjualan = Penjualan::where('PenjualanID', $id)->firstOrFail();
        // Get pelanggan list for selection
        $pelanggan = Pelanggan::all();

        return view('penjualan.edit', compact('penjualan', 'pelanggan'));
    }

    /**
     * Update the specified penjualan in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'TanggalPenjualan' => 'required|date',
            'TotalHarga' => 'required|numeric|min:0',
            'PelangganID' => 'required|exists:pelanggan,PelangganID',
        ]);

        // Find penjualan by PenjualanID
        $penjualan = Penjualan::where('PenjualanID', $id)->firstOrFail();

        // Update penjualan data
        $penjualan->update($request->all());

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui!');
    }

    /**
     * Remove the specified penjualan from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Find and delete the record
        $penjualan = Penjualan::where('PenjualanID', $id)->firstOrFail();
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}
