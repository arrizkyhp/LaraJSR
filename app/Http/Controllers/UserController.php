<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {

        return view('users.tambah');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($request->password);
        $status = Users::create($input);

        if ($status) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect('/users');
        } else {
            return redirect('/users')->with('error', 'Data gagal ditambahkan.');
        }
    }

    public function edit($id)
    {
        $users = Users::findOrFail($id);
        return view('users.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ]);

        $users = Users::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password) : $users->password;
        $users->update([
            'name' => $request->name,
            'password' => $password
        ]);

        alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
        return redirect('/users');
    }

    public function destroy($id)
    {
        $users = Users::findOrFail($id);
        $users->delete();
        alert()->success('Berhasil', 'Data Berhasil dihapus')->persistent('Close');
        return redirect('/users');
    }
}