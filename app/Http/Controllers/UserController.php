<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('role')
            ->sort($request)
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all(['id', 'name']);
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('users.index')->with('status', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Superadmins cannot be edited;
        abort_if($user->hasRole('superadmin'), Response::HTTP_NOT_FOUND);

        return view('users.edit', [
            'user' => $user->load('role'),
            'roles' => Role::all(['id', 'name'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        // Superadmins cannot be updated;
        abort_if($user->hasRole('superadmin'), Response::HTTP_UNPROCESSABLE_ENTITY);

        $user->update($request->validated());
        return redirect()->route('users.edit', $user->id)->with('status', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Superadmins cannot be deleted;
        abort_if($user->hasRole('superadmin'), Response::HTTP_UNPROCESSABLE_ENTITY);

        $user->delete();
        return redirect()->route('users.index')->with('status', 'User has been deleted successfully');
    }
}
