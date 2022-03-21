<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use App\Models\Infaq;
use App\Http\Controllers\Controller;
use App\Models\Uangkeluar;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    //


    public function UangMasuk(Request $request)
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

            $debit = Infaq::select('infaqs.amount', 'infaqs.pray', 'users.name', 'infaqs.updated_at')
                ->join('users', 'infaqs.user_id', '=', 'users.id')
                ->where('infaqs.status', '=', 'success')
                ->whereDate('infaqs.updated_at', '>=', $tanggal_awal)
                ->whereDate('infaqs.updated_at', '<=', $tanggal_akhir)
                ->get();

            $total = Infaq::where('status', '=', 'success')
                ->whereDate('infaqs.updated_at', '>=', $tanggal_awal)
                ->whereDate('infaqs.updated_at', '<=', $tanggal_akhir)
                ->sum();

            return response()->json([
                'success' => true,
                'data'    => ['Uang Masuk' => $debit, 'total' => $total]
            ], 401);
        }
    }


    public function getallUangMasuk(Request $request)
    {

        $debit = Infaq::select('infaqs.amount', 'infaqs.pray', 'users.name', 'infaqs.updated_at')
            ->join('users', 'infaqs.user_id', '=', 'users.id')
            ->where('infaqs.status', '=', 'success')
            ->get();

        $total = Infaq::where('status', '=', 'success')
            ->sum();

        return response()->json([
            'success' => true,
            'data'    => ['Uang Masuk' => $debit, 'total' => $total]
        ], 401);
    }
}
