<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }
    public function add(Request $request)
    {
        if (Auth::check()) {
            $productid = $request->input('productid');
            if (Product::find($productid)) {
                $wish = new Wishlist();
                $wish->productid = $productid;
                $wish->user_id = Auth::id();
                $wish->save();
                return response()->json(['status' => "Added on Favorites"]);
            } else {
                return response()->json(['status' => "Property does not exists"]);
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }
    public function deleteitem(Request $request)
    {
        if (Auth::check()) {
            $productid = $request->input('productid');
            if (Wishlist::where('productid', $productid)->where('user_id', Auth::id())->exists()) {
                $wish = Wishlist::where('productid', $productid)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Item Remove from Favorites "]);
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }
    public function wishlistcount()
    {
        $wishcount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishcount]);
    }
}
