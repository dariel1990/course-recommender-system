<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username'      => 'required|unique:users,username',
            'password'      => 'required|min:8',
            'email'         => 'required|unique:users,email',
        ]);

        $input = $request->all();

        $user = User::create([
            'username'      => $input['username'],
            'password'      => Hash::make($input['password']),
            'email'         => $input['email'],
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username'      => 'required|unique:users,username,' . $id,
            'password'      => 'same:confirm-password',
            'email'         => 'required|unique:users,email,' . $id,
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        try {
            DB::table("users")->where('id', $id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }

    //Update User Profile
    public function editProfile()
    {
        $userProfile = User::find(Auth::user()->id);
        return view('admin.users.edit-profile', compact('userProfile'));
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'username'      => 'required|unique:users,username,' . $id,
            'email'         => 'required|unique:users,email,' . $id,
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('edit.profile')
            ->with('success', 'Profile successfully updated.');
    }
}
