<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $user = User::create([
            'email' => $email,
            'password' => $password
        ]);

        return response()->json(['message' => 'Data added successfully'], 201);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'Login failed'], 401);
        }

        $isValidPassword = Hash::check($password, $user->password);

        if (!$isValidPassword) {
          return response()->json(['message' => 'Login failed'], 401);
        }

        $generateToken = bin2hex(random_bytes(40));

        $user->update([
            'token' => $generateToken
        ]);

        return response()->json($user);
    }

    // JWT Login
    public function loginJwt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],
        [
            'required'  => ':attribute harus diisi',
            'min'       => ':attribute minimal :min karakter',
            'email'       => ':attribute harus dengan format email yang benar',
        ]);

        if ($validator->fails()) {
            $resp = [
                'metadata' => [
                        'message' => $validator->errors()->first(),
                        'code'    => 422
                    ]
                ];
            return response()->json($resp, 422);
            die();
        }

        $user = User::where('email', $request->email)->first();

        if($user)
        {
            $isInvalidPassword = Hash::check($request->password, $user->password);

            if($isInvalidPassword)
            {

                // $token = \Auth::login($user);
                $credentials = request(['email', 'password']);

                if (!$token = auth()->attempt($credentials)) {

                }

                $resp = [
                    'response' => [
                        'token'=> $token
                    ],
                    'metadata' => [
                        'message' => 'OK',
                        'code'    => 200
                    ]
                ];

                return response()->json($resp);
            }else{

                $resp = [
                    'metadata' => [
                        'message' => 'Username Atau Password Tidak Sesuai',
                        'code'    => 401
                    ]
                ];

                return response()->json($resp, 401);
            }
        }else{
            $resp = [
                'metadata' => [
                    'message' => 'Username Atau Password Tidak Sesuai',
                    'code'    => 401
                ]
            ];

            return response()->json($resp, 401);
        }

    }
}
