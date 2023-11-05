<?php

namespace App\Http\Controllers;

use App\Models\detailpeminjaman;
use App\Models\pengembalianbuku;
use App\Models\peminjamanbuku;
use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class transaksicontroller extends Controller
{
    public function pinjambuku(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_siswa' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $save = peminjamanbuku::create([
            'id_siswa' => $req->input('id_siswa'),
            'tanggal_pinjam' => $req->input('tanggal_pinjam'),
            'tanggal_kembali' => $req->input('tanggal_kembali')
        ]);

        if ($save) {
            return response()->json(['successlur' => true]);
        } else {
            return response()->json(['gagal' => false]);
        }
    }

    public function tambahitem(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id_buku' => 'required',
            'qty' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $save = detailpeminjaman::create([
            'id_peminjaman_buku' => $id,
            'id_buku' =>$req->id_buku,
            'qty' =>$req->qty
        ]);
        if ($save) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }
    public function mengembalikanbuku(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_peminjaman_buku' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $cek_kembali = pengembalianbuku::where('id_peminjaman_buku', $req->id_peminjaman_buku);

        if ($cek_kembali->count() == 0) {
            $dt_kembali = peminjamanbuku::where('id_peminjaman_buku', $req->id_peminjaman_buku)->first();
            $tanggal_sekarang = Carbon::now()->format('Y-m-d');
            $tanggal_kembali = new Carbon($dt_kembali->tanggal_kembali);
            $dendaperhari = 1500;

            if (strtotime($tanggal_sekarang) > strtotime($tanggal_kembali)) {
                $jumlah_hari = $tanggal_kembali->diffInDays($tanggal_sekarang);
                $denda = $jumlah_hari * $dendaperhari;
            } else {
                $denda = 0;
            }

            $save = pengembalianbuku::create([
                'id_peminjaman_buku' => $req->id_peminjaman_buku,
                'tanggal_pengembalian' => $tanggal_sekarang,
                'denda' => $denda,
            ]);

            if ($save) {
                $data['status'] = 1;
                $data['message'] = 'Berhasil dikembalikan';
            } else {
                $data['status'] = 0;
                $data['message'] = 'Pengembalian gagal';
            }
        } else {
            $data = [
                'status' => 0,
                'message' => 'Sudah pernah dikembalikan',
            ];
        }

        return response()->json($data);
    }
}
