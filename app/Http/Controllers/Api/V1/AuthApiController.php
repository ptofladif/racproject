<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\RegisterEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response,200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }

        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }
    /**
     * Register api.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users|regex:/9[1236]\d{7}/',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'vat' => 'required|unique:users|nifextension',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $request['remember_token'] = Str::random(10);

        $user = User::create($input);

        $user->roles()->sync(3);

        $success['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;

        $user->sendEmailVerificationNotification();

//        if($user) {
//
//            $emailSubject = 'Notification from Rac App';
//
//            $title = 'Email Registration';
//
//            Mail::send( new RegisterEmail($emailSubject, $title, $user) );
//        }

        $success['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;



        return response()->json([
            'success' => true,
            'token' => $success,
            'user' => $user
        ]);

    }

    public function logout(Request $res)
    {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout'
            ]);
        }
    }
}
