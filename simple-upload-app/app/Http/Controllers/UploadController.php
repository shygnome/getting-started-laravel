<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function index()
    {
        $gambar = Gambar::all();
        return view('upload', ['gambar' => $gambar]);
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'keterangan' => 'required',
        ]);

        $file = $request->file('file');

        $nama_file = time() . "_" . $file->getClientOriginalName();

            $tujuan_upload = 'data_file';
        $file->move($tujuan_upload, $nama_file);

        Gambar::create([
            'file' => $nama_file,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back();
    }
}
