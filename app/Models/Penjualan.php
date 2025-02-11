<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; // Define the table name

    protected $primaryKey = 'PenjualanID'; // Custom primary key

    public $timestamps = true; // Enables created_at and updated_at

    protected $fillable = [
        'TanggalPenjualan',
        'PelangganID', // Removed 'TotalHarga' to prevent manual input
    ];

    // Prevent TotalHarga from being mass assignable
    protected $guarded = ['TotalHarga'];

    // Relationship with Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID', 'PelangganID');
    }

    // Relationship with DetailPenjualan
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'PenjualanID', 'PenjualanID');
    }

    // Dynamically calculate TotalHarga from related DetailPenjualan records
    public function getTotalHargaAttribute()
    {
        return $this->detailPenjualan->sum('Subtotal'); // Sum all related Subtotal values
    }
}
