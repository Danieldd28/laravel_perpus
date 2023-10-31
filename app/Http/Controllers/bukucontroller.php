<?php

namespace App\Http\Controllers;
use App\Models\buku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class bukucontroller extends Controller
{
    public function getbuku()
    {
        $dt_buku = buku::get();
        return response()->json($dt_buku);
    }

    public function addbuku(request $req)
    {
        $validator = validator::make($req->all(), [
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'deskripsi' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson());
            }
            $save = buku::create([
                'nama_buku' => $req->get('nama_buku'),
                'pengarang' => $req->get('pengarang'),
                'deskripsi' => $req->get('deskripsi')
            ]);
            if ($save) {
                return response()->json(['status' => true, 'message' => 'berhasil lur']);
            }else {
                return response()->json(['status' => false, 'message' => 'gagal lur']);
            }
    }
    public function updatebuku(Request $req,$id)
    {
        $validator = validator::make($req->all(),[
            'nama_buku' => 'required',
            'pengarang' => 'required',
            'deskripsi' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $ubah = buku::where('id', $id)->update([
            'nama_buku' => $req->get('nama_buku'),
                'pengarang' => $req->get('pengarang'),
                'deskripsi' => $req->get('deskripsi')
        ]);
            if ($ubah) {
                return response()->json(['status' => true, 'message' => 'berhasil update lur']);
            }else {
                return response()->json(['status' => false, 'message' => 'gagal update lur']);
            }
    }
    public function deletebuku($id)
    {
        $hapus = buku::where('id', $id)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'message' => 'berhasil hapus lur']);
            }else {
                return response()->json(['status' => false, 'message' => 'gagal hapus lur']);
            }
    }
    public function getbukuid($id)
    {
        $dt = buku::where('id', $id)->first();
        return response()->json($dt);
    }
}
