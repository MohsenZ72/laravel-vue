<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleEnum; 
class LoginRegisterController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'message' => 'Hello from the controller!'
        ];
        if( $request->expectsJson()){
            return redirect()->intended('login');
        }else{
            return view('app');
        }
        

        
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phoneNumber' =>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'confirmPass' => 'required|same:password'
        ]);
        $isFirstUser = !User::exists();
    
        $role = $isFirstUser ? RoleEnum::ADMIN : RoleEnum::CUSTOMER;

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'last_name' => $validatedData['lastName'],
            'role' =>$role,
            'phone_number' => $validatedData['phoneNumber'], 
            'password' => Hash::make($validatedData['password']),
        ]);
    
        // Generate and assign a token to the user's remember token field
        $token = $user->createToken('accessToken')->plainTextToken;
    
        return response()->json(['message' => 'User registered successfully', 'accessToken' => $token], 201);
    }
    

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);
    
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }

    $user = Auth::user();

    // Generate and assign a token to the user's remember token field
    $token = $user->createToken('Personal Access Token')->plainTextToken;

    return response()->json([
        'accessToken' => $token,
        'message' => 'User logged in successfully',
    ]);
}


public function logout()
{

    $user =  auth('sanctum')->user(); 
    $user->tokens()->delete();
    return redirect()->intended('/');
}


}


