<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\User;
use App\Models\UserCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->id();
        $certeficates = Certificate::get();
        $user_certificates = UserCertificate::where('user_id', $user)->get();
        return view('user.index', compact('certeficates', 'user_certificates'));
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
        $certificates = $request->input('selected_cards');


        $user = auth()->id();
        foreach ($certificates as $certificate) {

            UserCertificate::create([
                'c_id'    => $certificate,
                'user_id' => $user

            ]);
        }
        return redirect('/home')->with('message', 'certificate added successfully');
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

        return view('user.edit')->with('user', User::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'       => 'required',
            'email'       => 'required'

        ]);
        $password = $request->input('old_password');
        if ($request->filled('password')) {
            if ($request->input('password') === $request->input('retype_password')) {

                $password = bcrypt($request->input('password'));
            } else {
                return redirect()->back()->with('error', 'Password not matched');
            }
        }


        User::where('id', $id)->update([
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'sex'          => $request->input('sex'),
            'blood_type'   => $request->input('blood_type'),
            'password'     => $password,
            // 'updated_at'   => now()

        ]);
        return redirect('/home')->with('message', 'profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        UserCertificate::where('c_id', $id)->delete();
        return redirect('/home')->with('message', 'certeficate deleted successfully');
    }
}
