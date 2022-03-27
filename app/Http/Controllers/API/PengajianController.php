<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajian;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PengajianController extends Controller
{
    //
    protected $status = null;
    protected $error = null;
    protected $data = null;

    public function index()
    {
        return Pengajian::when(request('search'), function ($query) {
            $query->where('judul', 'like', '%' . request('search') . '%');
        })->orderBy('id', 'desc')->paginate(5);
    }
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'judul' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg|max:2048',
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response(
                [
                    'status' => "failed",
                    'data' => ["message" => "data salah"],
                    'error' => $validator->errors(),
                ]
            );
        }
        $date = Carbon::now()->toDateString();
        $document = new Pengajian();
        $document->judul = $request->judul;
        $document->deskripsi = $request->deskripsi;
        $document->tanggal = $date;
        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('Pengajian'), $file_name);
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
            "data" => $this->data,
            "error" => $this->error
        ]);
    }

    public function show($id)
    {
        //
        try {
            if ($id) {
                $pengajian = Pengajian::where('id', $id)->first();
            } else {
                $pengajian = Pengajian::get();
            }
            $this->data = $pengajian;
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
            'deskripsi' => 'required',
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
        $pengajian = Pengajian::find($id);
        $pengajian->judul = $request->judul;
        $pengajian->deskripsi = $request->deskripsi;
        $pengajian->tanggal = $date;
        if ($request->foto && $request->foto->isValid()) {
            $file_name = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('Pengajian'), $file_name);
            $path = $file_name;
            $pengajian->foto = $path;
        }
        $pengajian->update();
        return response()->json([
            'status' => 'success',
            'data' => $pengajian,
            'messagge' => 'data berhasil di update'
        ]);
    }

    public function destroy($id)
    {
        //
        $pengajian = Pengajian::where('id', $id);
        $pengajian->delete();

        return response(
            [
                'status' => "success",
                'data' => ["message" => "data berhasil di hapus"],
                'erorr' => ''
            ]
        );
    }
}
