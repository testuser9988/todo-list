<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function destroy()
    {
        $user = User::find(\Auth::id());
        $user->delete();
        return redirect('/');
    }

    public function delete()
    {

        return view('users.delete');
    }
}
