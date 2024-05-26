<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException; 
use Exception;

class UserController extends Controller
{
    public function storeCustomer(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Registration Success.'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors() 
            ], 422); 
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Registration Failed',
                'error' => $e->getMessage() 
            ], 500); 
        }
    }



    public function storeStaff(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'role' => 'required|in:admin,staff,customer',
                'password' => 'required|string|min:6',
            ]);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Registration Success.'
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Failed',
                'errors' => $e->errors() 
            ], 422); 
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Registration Failed',
                'error' => $e->getMessage() 
            ], 500); 
        }
    }
}

