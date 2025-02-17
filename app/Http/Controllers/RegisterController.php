<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        
        $input = $request->all();
        
        User::create([
            'name' => $input['name'],
            'email'=> $input['email'],
            'password'=> Hash::make($input['password'])
        ]);
        
        return response()->json(['status'=>true, 'message'=>"Registration Success"]);
    }
}
