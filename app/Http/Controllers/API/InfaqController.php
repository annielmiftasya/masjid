<?php

namespace App\Http\Controllers\API;

use Midtrans\Snap;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Infaq;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InfaqController extends Controller
{
   /**
    * __construct
    *
    * @return void
    */

   protected $status = null;
   protected $error = null;
   protected $data = null;

   public function __construct()
   {
      // Set midtrans configuration
      \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
      \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
      \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
      \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
   }

   /**
    * index
    *
    * @return void
    */


   public function search()
   {
      //
      return DB::table('infaqs')->select(
         'infaqs.invoice',
         'infaqs.amount',
         'infaqs.pray',
         'infaqs.snap_token',
         'infaqs.status',
         'infaqs.updated_at',
         'users.name'
      )
         ->join('users', 'infaqs.user_id', '=', 'users.id')
         ->when(request('search'), function ($query) {
            $query->where('infaqs.updated_at', 'like', '%' . request('search') . '%');
         })
         ->paginate(5);

      // return Infaq::when(request('search', 'search1'), function ($query) {
      //    $query->whereBetween('updated_at', [request('search'), request('search1')]);
      // })->where('user_id', auth()->guard('user-api')->user()->id)->latest()->orderBy('id', 'desc')->paginate(5);
   }
   public function index()
   {
      //get data donations
      $donations = Infaq::where('user_id', auth()->guard('user-api')->user()->id)->latest()->paginate(5);

      //return with response JSON
      return response()->json([
         'success' => true,
         'message' => 'List Data Infaq : ' . auth()->guard('user-api')->user()->name,
         'data'    => $donations,
      ], 200);
   }

   public function GetAdmin()
   {
      //
      try {
         $infaq = DB::table('infaqs')->select(
            'infaqs.invoice',
            'infaqs.amount',
            'infaqs.pray',
            'infaqs.snap_token',
            'infaqs.status',
            'infaqs.updated_at',
            'users.name'
         )->join('users', 'users.id', '=', 'infaqs.user_id')->paginate(5);


         $this->data = $infaq;
         $this->status = "success";
      } catch (QueryException $e) {
         $this->status = "failed";
         $this->error = $e;
      }
      return response()->json([
         "status" => $this->status,
         "data" =>  $this->data,
         "error" => $this->error
      ]);
   }

   public function SumInfaq()
   {
      //

      return Infaq::where('status', 'success')->sum('amount');



      // return response()->json($total);
   }

   /**
    * store
    *
    * @param  mixed $request
    * @return void
    */
   public function store(Request $request)
   {
      DB::transaction(function () use ($request) {

         /**
          * algorithm create no invoice
          */
         $length = 10;
         $random = '';
         for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
         }

         $no_invoice = 'TRX-' . Str::upper($random);

         $user = Auth::user()->id;
         // $user = User::find($request->user());
         // $user = auth()->guard('user')->user()->id;
         $donation = Infaq::create([
            'invoice'       => $no_invoice,
            'user_id'       => $user,
            'amount'        => $request->amount,
            'pray'          => $request->pray,
            'status'        => 'pending',
         ]);

         // Buat transaksi ke midtrans kemudian save snap tokennya.

         $payload = [
            'transaction_details' => [
               'order_id'      => $donation->invoice,
               'gross_amount'  => $donation->amount,
            ],
            'customer_details' => [
               'first_name'       => Auth::user()->name,
               'email'            => Auth::user()->email,
            ]
         ];

         //create snap token
         $snapToken = Snap::getSnapToken($payload);
         $donation->snap_token = $snapToken;
         $donation->save();

         $this->response['snap_token'] = $snapToken;
      });

      return response()->json([
         'success' => true,
         'message' => 'Donasi Berhasil Dibuat!',
         $this->response
      ]);
   }

   /**
    * notificationHandler
    *
    * @param  mixed $request
    * @return void
    */
   public function notificationHandler(Request $request)
   {
      $payload      = $request->getContent();
      $notification = json_decode($payload);

      $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.serverKey'));

      if ($notification->signature_key != $validSignatureKey) {
         return response(['message' => 'Invalid signature'], 403);
      }

      $transaction  = $notification->transaction_status;
      $type         = $notification->payment_type;
      $orderId      = $notification->order_id;
      $fraud        = $notification->fraud_status;

      //data donation
      $data_donation = Infaq::where('invoice', $orderId)->first();

      if ($transaction == 'capture') {

         // For credit card transaction, we need to check whether transaction is challenge by FDS or not
         if ($type == 'credit_card') {

            if ($fraud == 'challenge') {

               /**
                *   update invoice to pending
                */
               $data_donation->update([
                  'status' => 'pending'
               ]);
            } else {

               /**
                *   update invoice to success
                */
               $data_donation->update([
                  'status' => 'success'
               ]);
            }
         }
      } elseif ($transaction == 'settlement') {

         /**
          *   update invoice to success
          */
         $data_donation->update([
            'status' => 'success'
         ]);
      } elseif ($transaction == 'pending') {


         /**
          *   update invoice to pending
          */
         $data_donation->update([
            'status' => 'pending'
         ]);
      } elseif ($transaction == 'deny') {


         /**
          *   update invoice to failed
          */
         $data_donation->update([
            'status' => 'failed'
         ]);
      } elseif ($transaction == 'expire') {


         /**
          *   update invoice to expired
          */
         $data_donation->update([
            'status' => 'expired'
         ]);
      } elseif ($transaction == 'cancel') {

         /**
          *   update invoice to failed
          */
         $data_donation->update([
            'status' => 'failed'
         ]);
      }
   }
}
