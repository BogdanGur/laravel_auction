<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LotController extends Controller
{
    public function index($url) {

        $lot_id = Lot::select("id")->where('url', $url)->first();

        if(Cookie::get('lot_view_'.$lot_id->id) == 0) {
            Cookie::queue('lot_view_'.$lot_id->id, 1, time()+3600*24*28);

            Lot::find($lot_id->id)->increment('views', 1);
        }

        return view('lot_page', ['lot' => Lot::where('url', $url)->first(), 'bets' => Bet::where('lot_id', $lot_id->id)->get()]);
    }

    public function userBet(Request $request) {
        $bet = new Bet();

        $bet->user_id = Auth::id();
        $bet->lot_id = $request->lot_id;
        $bet->bet = $request->price;
        $bet->save();

        return back()->with('success', 'Done!');
    }
}
