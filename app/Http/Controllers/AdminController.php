<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index() {
        if(Auth::guard('admin')->check()) {

            return view('admin.admin', ['categories' => Category::all(), 'users' => User::all(), 'admin' => Admin::find(Auth::guard('admin')->id())]);
        }
        return redirect()->route('admin.login_show');
    }

    public function loginShow() {

        return view('admin.login');
    }

    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin');
        }

        return redirect()->route('admin.login_show');
    }

    public function logout() {

        Session::flush();
        Auth::guard('admin')->logout();

        return back();
    }


    public function addCategory(Request $request) {

        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->save();

        return back()->with('success', 'Category successfully created');

    }

    public function deleteCategory($id) {
        Category::find($id)->delete();

        return response('success');
    }

    public function deleteUser($id) {
        User::find($id)->delete();

        return response('success');
    }
}
