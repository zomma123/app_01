<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class UserController extends Controller
{
    //

    public function register(Request $request){
        try {

            $Check_email = User::where('email', $request->email);
            if ($Check_email->count()) {
                $success = false;
                $message = "ອີເມວນີ້ມີໃນລະບົບແລ້ວ!";
            } else {
                $user = new User();
                $user->name = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

                $success = true;
                $message = "ລົງທະບຽນສຳເລັດ";
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $reponse = [
            "success" => $success,
            "message" => $message,
        ];
        return response()->json($reponse);
    }

    public function login(Request $request) {
        $user_login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($user_login)) {
            $success = true;
            $message = "ເຂົ້າສູ່ລະບົບສຳເລັດ";
        } else {
            $success = false;
            $message = "ອີເມລ໌ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ!";
        }
        $reponse = [
            "success" => $success,
            "message" => $message,
        ];
        return response()->json($reponse);
    }

    public function logout(){
        try {

            Session::flush();
            $success = true;
            $message = "ສຳເລັດ";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $reponse = [
            "success" => $success,
            "message" => $message,
        ];
        return response()->json($reponse);
    }
}
