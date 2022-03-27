<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalSholat;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class JadwalSholatController extends Controller
{
    protected $status = null;
    protected $error = null;
    protected $data = null;

    public function index()
    {
        //
        return JadwalSholat::when(request('search', 'search1'), function ($query) {
            $query->whereBetween('tanggal', [request('search'), request('search1')]);
        })->orderBy('id', 'desc')->paginate(5);
    }

    public function index1()
    {
        //
        return JadwalSholat::orderBy('id', 'desc')->paginate(5);
    }
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'tanggal' => 'required',
            'imsyak'  => 'required',
            'shubuh' => 'required',
            'terbit' => 'required',
            'dhuha' => 'required',
            'dzuhur' => 'required',
            'ashr' => 'required',
            'magrib' => 'required',
            'isya' => 'required'
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

        $document = new JadwalSholat();
        $document->tanggal = $request->tanggal;
        $document->imsyak = $request->imsyak;
        $document->shubuh = $request->shubuh;
        $document->terbit = $request->terbit;
        $document->dhuha = $request->dhuha;
        $document->ashr = $request->ashr;
        $document->magrib = $request->magrib;
        $document->isya = $request->isya;
        $document->dzuhur = $request->dzuhur;

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
                $sholat = JadwalSholat::where('id', $id)->first();
            } else {
                $sholat = JadwalSholat::get();
            }
            $this->data = $sholat;
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
            'tanggal' => 'required',
            'imsyak'  => 'required',
            'shubuh' => 'required',
            'terbit' => 'required',
            'dhuha' => 'required',
            'dzuhur' => 'required',
            'ashr' => 'required',
            'magrib' => 'required',
            'isya' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all()[0];
            return response()->json([
                'status' => 'failed',
                'message' => $error,
                'data' => []
            ]);
        }
        $document = JadwalSholat::find($id);
        $document->tanggal = $request->tanggal;
        $document->imsyak = $request->imsyak;
        $document->shubuh = $request->shubuh;
        $document->terbit = $request->terbit;
        $document->dhuha = $request->dhuha;
        $document->ashr = $request->ashr;
        $document->magrib = $request->magrib;
        $document->isya = $request->isya;

        $document->update();
        return response()->json([
            'status' => 'success',
            'data' => $document,
            'messagge' => 'data berhasil di update'
        ]);
    }

    public function destroy($id)
    {
        //
        $sholat = JadwalSholat::where('id', $id);
        $sholat->delete();

        return response(
            [
                'status' => "success",
                'data' => ["message" => "data berhasil di hapus"],
                'erorr' => ''
            ]
        );
    }
    public function filter(Request $request)
    {
        $this->validate($request, [
            'tanggal'  => 'required',
        ]);

        $tanggal  = $request->tanggal;

        //get data donation by range date
        $jadwal = JadwalSholat::where('status', 'success')
            ->whereDate('tanggal', '>=', $request->tanggal)
            ->get();


        return view('admin.donation.index', compact('jadwal', 'total'));
    }
}
