<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    protected $status = null;
    protected $error = null;
    protected $data = null;

    public function show($id)
    {
        //find by ID
        $user = User::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data',
            'data'    => $user
        ], 200);
    }
    public function index(Request $request)
    {
        $user = User::find($request->user());
        return response()->json([
            'success' => true,
            'message' => 'List Data',
            'data'    => $user
        ], 200);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request, $id)
    {
        //get data profile
        // $donatur = User::whereId(auth()->guard('user-api')->user()->id)->first();
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        //find by ID
        $donatur = User::find($id);
        if ($donatur) {
            //update with upload avatar
            if ($request->file('avatar')) {

                //hapus image lama
                Storage::disk('local')->delete('public/users/' . basename($donatur->image));

                //upload image baru
                $image = $request->file('avatar');
                $image->storeAs('public/users', $image->hashName());

                $donatur->update([
                    'name'      => $request->name,
                    'avatar'    => $image->hashName()
                ]);
            }

            //update without avatar
            $donatur->update([
                'name'      => $request->name,
            ]);
        }
        try {
            $this->data = $donatur;
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

    /**
     * updatePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $donatur = User::find($id);
        $donatur->update([
            'password'  => Hash::make($request->password)
        ]);


        //return with response JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Password Berhasil Diupdate!',
            'data'    => $donatur,
        ], 201);
    }
}
