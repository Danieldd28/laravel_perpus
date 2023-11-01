<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjamanbuku extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_buku';
    protected $primarykey = 'id_peminjaman_buku';
    public $timestamps = false;
    public $fillable = [
        'id_siswa',
        'tanggal_pinjam',
        'tanggal_kembali'
    ];
}
