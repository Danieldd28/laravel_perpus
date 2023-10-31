<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class siswacontroller extends Controller
{
    public function getsiswa()
    {
        $dt_siswa = siswa::get();
        return response()->json($dt_siswa);
    }
    public function addsiswa(Request $req)
    {
        $validator = validator::make($req->all(), [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_kelas' => 'required'    
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }
        $save =  siswa::create([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'username' => $req->get('username'),
            'password' => $req->get('password'),
            'id_kelas' => $req->get('id_kelas')
        ]);
        if ($save) {
            return response()->json(['status' => true, 'message' => 'SuksesLur']);
        } else {
            return response()->json(['status' => false, 'message' => 'GagalLur']);
        }
    }
    public function updatesiswa(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'nama_siswa' => 'required',
            'tanggal_lahir' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_kelas' => 'required'  
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson());
        }

        $ubah = siswa::where('id_siswa', $id)->update([
            'nama_siswa' => $req->get('nama_siswa'),
            'tanggal_lahir' => $req->get('tanggal_lahir'),
            'gender' => $req->get('gender'),
            'alamat' => $req->get('alamat'),
            'username' => $req->get('username'),
            'password' => $req->get('password'),
            'id_kelas' => $req->get('id_kelas')
        ]);

        if ($ubah) {
            return response()->json(['status' => true, 'message' => 'Sukses Masbro']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Masbro']);
        }
    }
    public function deletesiswa($id)
    {
        $hapus=siswa::where('id_siswa',$id)->delete();
        if ($hapus) {
            return response()->json(['status' => true, 'message' => 'Sukses Masbro']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal Masbro']);
        }
    }
    public function getsiswaid($id)
    {
        $dt=siswa::where('id_siswa',$id)->first();
        return Response()->json($dt);
    }

}
