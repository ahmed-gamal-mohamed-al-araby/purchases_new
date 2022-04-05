<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Supplier\Prod_Supplier;
use App\Supplier\Product;
use App\Supplier\Service;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{



    public function index(){


        $users = User::all();
        $users_count=  $users->count();

        return view('pages.users.users',compact('users','users_count'));
    }
    public  function  edit($id){

        $user = User::find($id);
        $users_count=  User::all()->count();

        return view('pages.users.edit',compact('user','users_count'));

    }
    public function update(Request $request,$id){

        $users = User::findOrFail($id);
        $input = $request->except(['permissions']);
        $users->update($input);
        if($users->hasRole('admin')){
            $users->syncPermissions($request->permissions);
        }else{
            $users->attachRole('admin');
            $users->syncPermissions($request->permissions);
        }


        Toastr::success(trans('site.users_success_edit'),trans('site.success'));
        return redirect('/users');

    }

    public function  getProfile(Request $request,$id){
        $user = User::find($id);
        $users_count=  User::all()->count();

        return view('pages.users.profile',compact('user','users_count'));
    }
}
