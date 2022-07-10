<?php

namespace App\Http\Controllers;

use App\Http\Requests\LotRequest;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index() {

        return view('account', ['user' => User::find(Auth::id()), 'lots' => Lot::where('user_id', Auth::id())->get(), 'categories' => Category::all()]);
    }

    public function updateUser(UserRequest $request) {
        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request->hasFile('photo')) {
            if($user->photo) Storage::delete('/public/user_photos/'.$user->photo);

            $request->photo->store("user_photos", 'public');
            $user->photo = $request->photo->hashName();
        }
        $user->save();

        return back()->with('success', 'Profile information successfully update');
    }

    public function addLot(LotRequest $request) {
        $lot = new Lot();

        $lot->user_id = Auth::id();
        $lot->category_id = $request->category;
        $lot->url = Str::slug($request->name_lot);
        $lot->name = $request->name_lot;
        $lot->description = $request->description;
        $lot->start_price = $request->start_price;
        $lot->save();

        if($request->hasFile('images')) {
            $i = 1;
            foreach($request->images as $img) {
                $image = new Image();

                $img->store('product_images','public');

                $image->lot_id = $lot->id;
                $image->img = $img->hashName();
                $image->sorting = $i;
                $image->save();

                $i++;
            }
        }

        return back()->with('success', 'Lot successfully added');
    }

    public function updateLot(Request $request) {
        $lot = Lot::find($request->lot_id);

        $lot->category_id = $request->category;
        $lot->url = Str::slug($request->name_lot);
        $lot->name = $request->name_lot;
        $lot->description = $request->description;
        $lot->start_price = $request->start_price;
        $lot->save();

        if($request->hasFile('images')) {
            $images = Image::where('lot_id', $lot->id)->get();

            foreach($images as $image) {
                Storage::delete('/public/product_images/'.$image->img);
                $image->delete();
            }

            $i = 1;
            foreach($request->images as $img) {
                $image = new Image();

                $img->store('product_images','public');

                $image->lot_id = $lot->id;
                $image->img = $img->hashName();
                $image->sorting = $i;
                $image->save();

                $i++;
            }
        }

        return back()->with('success', 'Lot successfully updated');
    }

    public function deleteLot($id) {
        $images = Image::where('lot_id', $id)->get();

        foreach($images as $image) {
            Storage::delete('/public/product_images/'.$image->img);
            $image->delete();
        }

        Lot::find($id)->delete();

        return response('success');
    }
}
