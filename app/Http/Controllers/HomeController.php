<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $cat_filter = \request('category');
        if($cat_filter) $lots = Lot::where('category_id', $cat_filter)->get();
        else $lots = Lot::all();

        return view('home', ['lots' => $lots, 'category' => Category::all()]);
    }
}
