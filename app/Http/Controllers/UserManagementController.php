<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;


class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Dashboard | Users Management";
        $users=User::all();
        return view('dashboard.users_management.index')->with('users',$users)->with('title',$title);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname'    => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'lastname'     => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'phone_number' => ['required', 'string', 'regex:/^0[67][0-9]{8}$/', 'unique:users,phone_number'],
            'email'        => ['required', 'email', 'max:100', 'unique:users,email'],
            'role'         => ['required', 'string'],
        ]);
    
        $password = "Mpya@2025"; // Default password for new users
        $user = new User;
        $user->firstname = trim($request->input('firstname'));
        $user->lastname = trim($request->input('lastname'));
        $user->phone = trim($request->input('phone_number'));
        $user->email = trim($request->input('email'));
        $user->role = trim($request->input('role'));
        //$user->pharmacy_id = Auth::user()->pharmacy_id;
        $user->password = Hash::make($password);
        $user->save();
    
        return redirect()->route('users_management.index')->with('success', 'User added successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'firstname'    => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'lastname'     => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'phone_number' => ['required', 'string', 'regex:/^0[67][0-9]{8}$/', "unique:users,phone,$id"],
            'email'        => ['required', 'email', 'max:100', "unique:users,email,$id"],
            'role'         => ['required', 'string', 'in:pharmacy_owner,staff'],
        ]);
    
        $user = User::findOrFail($id);
        $user->update([
            'firstname'    => trim($data['firstname']),
            'lastname'     => trim($data['lastname']),
            'phone'        => trim($data['phone_number']),
            'email'        => trim($data['email']),
            'role'         => trim($data['role']),
        ]);
    
        return redirect()->route('users_management.index')->with('success', 'User updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

    return redirect()->route('users_management.index')->with('success', 'User deleted successfully.');

    }
}
