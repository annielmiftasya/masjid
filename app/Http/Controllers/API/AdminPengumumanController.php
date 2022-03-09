<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminPengumumanController extends Controller
{
    //
    protected $status = null;
    protected $error = null;
    protected $data = null;

    public function index()
    {
        //
        try {
            $pengumuman = Pengumuman::get();
            $this->data = $pengumuman;
            $this->status = "success";
        } catch (QueryException $e) {
            $this->status = "failed";
            $this->error = $e;
        }
        return response()->json([
            "status" => $this->status,
            "data" => $this->data,
            "error" => $this->error
        ]);
    }
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'judul' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:2048',
            'isi' => 'required',
        ]);

        if ($validator->fails()) {
            return  response()->json(
                [
                    'status' => "failed",
                    'pesan' => ["message" => "data salah"],
                    'data' => $validator->errors(),
                ]
            );
        }
        $date = Carbon::now()->toDateString();
        $document = new Pengumuman();
        $document->judul = $request->judul;
        $document->isi = $request->isi;
        $document->tanggal = $date;
        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('pengumuman'), $file_name);
            $path = $file_name;
            $document->foto = $path;
        }

        try {
            $document->save();
            $this->data = $document;
            $this->status = "success";
        } catch (QueryException $e) {
            $this->status = "failed";
            $this->error = $e;
        }
        return response()->json([
            "status" => $this->status,
            "hasil" => $this->data,
            "data" => $this->error
        ]);
    }

    public function show($id)
    {
        //
        try {
            if ($id) {
                $berita = Pengumuman::where('id', $id)->first();
            } else {
                $berita = Pengumuman::get();
            }
            $this->data = $berita;
            $this->status = "success";
        } catch (QueryException $e) {
            $this->status = "failed";
            $this->error = $e;
        }
        return response()->json([
            "status" => $this->status,
            "data" => $this->data,
            "error" => $this->error
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all()[0];
            return response()->json([
                'status' => 'failed',
                'message' => $error,
                'data' => []
            ]);
        }
        $date = Carbon::now()->toDateString();
        $pengumuman = Pengumuman::find($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;
        $pengumuman->tanggal = $date;
        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('pengumuman'), $file_name);
            $path = $file_name;
            $pengumuman->foto = $path;
        }
        $pengumuman->update();
        return response()->json([
            'status' => 'success',
            'data' => $pengumuman,
            'messagge' => 'data berhasil di update'
        ]);
    }

    public function destroy($id)
    {
        //
        $pengumuman = Pengumuman::where('id', $id);
        $pengumuman->delete();

        return response(
            [
                'status' => "success",
                'data' => ["message" => "data berhasil di hapus"],
                'erorr' => ''
            ]
        );
    }
    public function currentAdmin(Request $request)
    {
        $admin = Admin::find($request->user());
        return response()->json($admin);
    }
}
