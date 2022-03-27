<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Uangmasuk;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class UangMasukController extends Controller
{
    //
    //
    protected $status = null;
    protected $error = null;
    protected $data = null;


    public function showdata($id)
    {
        //
        try {
            if ($id) {
                $berita = Uangmasuk::where('id', $id)->first();
            } else {
                $berita = Uangmasuk::get();
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

    public function SumUangMasuk()
    {
        //
        return Uangmasuk::sum('nominal');


        // try {
        //     $total = Uangmasuk::sum('nominal');

        //     $this->data = $total;
        //     $this->status = "success";
        // } catch (QueryException $e) {
        //     $this->status = "failed";
        //     $this->error = $e;
        // }
        // return response()->json([
        //     "status" => $this->status,
        //     "data" => $this->data,
        //     "error" => $this->error
        // ]);
    }
    public function index()
    {
        //
        try {
            $uangmasuk = Uangmasuk::paginate(5);

            $this->data = $uangmasuk;
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
            'nominal' => 'required',
            'bukti' => 'required|mimes:jpg,png,jpeg|max:2048',
            'keterangan' => 'required',
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
        $credit = new Uangmasuk();
        $credit->nominal = $request->nominal;
        $credit->keterangan = $request->keterangan;
        $credit->date = $date;
        if ($request->bukti && $request->bukti->isValid()) {
            $file_name = $request->bukti->getClientOriginalName();
            $request->bukti->move(public_path('Uangmasuk'), $file_name);
            $path = $file_name;
            $credit->bukti = $path;
        }

        try {
            $credit->save();
            $this->data = $credit;
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

    public function show($request)
    {
        $validator = Validator::make(
            $request->all(),
            [

                'tanggal_awal'     => 'required',
                'tanggal_akhir'    => 'required',

            ],
            [
                'tanggal_awal.required'  => 'Silahkan Pilih Tanggal Awal!',
                'tanggal_akhir.required' => 'Silahkan Pilih Tanggal Akhir!',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'data'    => $validator->errors()
            ], 401);
        } else {

            $tanggal_awal  = $request->input('tanggal_awal');
            $tanggal_akhir = $request->input('tanggal_akhir');

            $credit = Uangmasuk::whereDate('infaqs.updated_at', '>=', $tanggal_awal)
                ->whereDate('infaqs.updated_at', '<=', $tanggal_akhir)
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $credit
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'nominal' => 'required',
            'keterangan' => 'required',
            'bukti' => 'required|mimes:jpg,png,jpeg|max:2048',
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
        $credit = Uangmasuk::find($id);
        $credit->nominal = $request->nominal;
        $credit->keterangan = $request->keterangan;
        $credit->date = $date;
        if ($request->bukti && $request->bukti->isValid()) {
            $file_name = $request->bukti->getClientOriginalName();
            $request->bukti->move(public_path('Uangmasuk'), $file_name);
            $path = $file_name;
            $credit->bukti = $path;
        }
        $credit->update();
        return response()->json([
            'status' => 'success',
            'data' => $credit,
            'messagge' => 'data berhasil di update'
        ]);
    }

    public function destroy($id)
    {
        //
        $credit = Uangmasuk::where('id', $id);
        $credit->delete();

        return response(
            [
                'status' => "success",
                'data' => ["message" => "data berhasil di hapus"],
                'erorr' => ''
            ]
        );
    }
}
