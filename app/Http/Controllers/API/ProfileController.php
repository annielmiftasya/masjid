<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function index()
    {
        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Profile',
            'data'    => Auth::user(),
        ], 200);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        //get data profile
        $donatur = User::whereId(auth()->guard('user-api')->user()->id)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }



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

        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Profile Berhasil Diupdate!',
            'data'    => $donatur,
        ], 201);
    }

    /**
     * updatePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $donatur = User::whereId(auth()->guard('user-api')->user()->id)->first();
        $donatur->update([
            'password'  => Hash::make($request->password)
        ]);


        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Password Berhasil Diupdate!',
            'data'    => $donatur,
        ], 201);
    }
}
