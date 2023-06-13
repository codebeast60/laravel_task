<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCertificate;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::where('groupID', 0)->get();
        $certeficates = Certificate::get();
        $user_certificates = UserCertificate::get();
        $counts = DB::table('user_certificates')->select('c_id', DB::raw('COUNT(*) as count'))->groupBy('c_id')->get();

        return view('admin.index', compact('users', 'certeficates', 'user_certificates'), ['counts' => $counts]);
    }

    /*
    * activate users
    */
    public function updateStatus($id)
    {
        $user = User::findOrFail($id);

        $user->approved = $user->approved ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required'

        ]);


        Certificate::create([
            'name'         => $request->input('name'),
            'description'  => $request->input('description'),

        ]);

        return redirect('/admin');
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
        return view('admin.edit')->with('user', User::where('id', $id)->first());
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

        return redirect('/admin')->with('message', 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Certificate::where('id', $id)->delete();
        return redirect('/admin')->with('message', 'certeficate deleted successfully');
    }
}
