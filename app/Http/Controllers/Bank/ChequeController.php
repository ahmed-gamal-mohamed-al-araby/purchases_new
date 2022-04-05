<?php

namespace App\Http\Controllers\Bank;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ChequeController extends Controller
{
   
    public function index(){


        $users = User::all();
        $users_count=  $users->count();

        return view('pages.users.users',compact('users','users_count'));
    }
}
