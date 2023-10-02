<?php

namespace App\Http\Controllers\API;

use App\Mail\VerifyEmail;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $user->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            'account_type_id' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type_id' => $request->account_type_id,
            'user_type' => 'Member',
        ]);

        //first check if user creation was successful
        if (!$user) {
            return response()->json([
                'message' => 'Account creation failed',
            ], 500);
        }

        //generate random code
        $code = rand(100000, 999999);

        //save code to database
        $verificationCode = new VerificationCode();
        $verificationCode->email = $user->email;
        $verificationCode->code = $code;
        $verificationCode->save();

        if(!$verificationCode){
            return response()->json([
                'message' => 'Account creation failed',
            ], 500);
        }
        //send email to the user
        Mail::to($user->email)->send(new VerifyEmail($code, $user->name));

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    //verify email using the code
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'code' => ['required', 'string'],
        ]);

        $verificationCode = VerificationCode::where('email', $request->email)->where('code', (int)$request->code)->first();

        if (!$verificationCode) {
            return response()->json([
                'message' => 'Invalid verification code',
            ], 401);

            }

        //update user email_verified_at column
        $user = User::where('email', $request->email)->first();
        $user->email_verified_at = now();

        if (!$user->save()) {
            return response()->json([
                'message' => 'Verification failed',
            ], 500);
        }

        //delete verification code from database
        $verificationCode->delete();

        return response()->json([
            'message' => 'Email verified successfully',
        ], 200);
    }

}
