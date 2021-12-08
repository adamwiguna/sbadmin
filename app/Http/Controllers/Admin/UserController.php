<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create', [
            'dataOpd' => Division::orderBy('nama', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required',
            'password' => 'required|confirmed',
            'bidang' => 'reqired',
            'jabatan' => 'required',
            'opd' => 'required',
            'singkatanJabatan' => 'required',
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->username,
            'division_id' => $request->opd,
            'password' => bcrypt($request->password),
            'jabatan' => $request->jabatan,
            'jabatan_singkatan' => $request->singkatanJabatan,
            'slug' =>  Str::random(50),
        ]);

        $request->session()->flash('message', 'Berhasil menambahkan User baru');
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user,
            'dataOpd' => Division::orderBy('nama', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required',
            'password' => 'confirmed',
            'bidang' => 'reqired',
            'jabatan' => 'required',
            'opd' => 'required',
            'singkatanJabatan' => 'required',
        ]);

    
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->nama;
        $user->email = $request->username;
        $user->division_id = $request->opd;
        $user->jabatan = $request->jabatan;
        $user->jabatan_singkatan = $request->singkatanJabatan;
        $user->save();
        
        $request->session()->flash('message', 'Berhasil mengubah User '.$user->name);
        return redirect()->route('admin.user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
