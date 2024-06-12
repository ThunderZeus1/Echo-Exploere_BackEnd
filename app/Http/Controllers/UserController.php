<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
public function index()
{
return view('users.index'); // Return the new view
}

    public function manageUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get(); // Retrieve users in descending order of creation
        return view('users.manage-users', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.manage-users')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.manage-users')->with('success', 'User deleted successfully');
    }

}
