<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function user_create()
    {
        $user = new User;
        $user->name = 'Test';
        $user->email = 'test@gmail.com';
        $user->password = Hash::make('123456789');
        $user->save();
        return "User Created successfully!";
    }
}
