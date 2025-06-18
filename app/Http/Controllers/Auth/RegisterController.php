<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pharmacy_name' => 'required|string|unique:pharmacies,name',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string|unique:pharmacies,phone',
            'email' => 'required|email|unique:pharmacies,email|unique:users,email',
            'password' => 'required|min:6',
            'address' => 'required|string',
            'city' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create Pharmacy
        $pharmacy = Pharmacy::create([
            'name' => $request->pharmacy_name,
            'owner_name' => $request->firstname,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'subscription_plan' => 'free',
            'status' => 'active',
        ]);

        // Create User and associate with Pharmacy
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'pharmacy_owner',
            'pharmacy_id' => $pharmacy->id, // Associate with pharmacy
        ]);

        // Redirect with success message
        return redirect()->route('register.pharmacy')->with('success', 'Pharmacy registered successfully!');
    }
}
