<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $productid = $request->input('productid');
        $productquant = $request->input('productquant');

        if (Auth::check()) {
            $prod_check = Product::where('id', $productid)->first();

            if ($prod_check) {
                if (Cart::where('productid', $productid)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->prodname . " This is already in Saved Properties"]);
                } else {
                    $cartItem = new Cart();
                    $cartItem->productid = $productid;
                    $cartItem->user_id = Auth::id();
                    $cartItem->productquantity = $productquant;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->prodname . " Added to Saved Properties"]);
                }
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function viewcart()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cartitems'));
    }
    public function deleteproduct(Request $request)
    {
        if (Auth::check()) {
            $productid = $request->input('productid');
            if (Cart::where('productid', $productid)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('productid', $productid)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Item Deleted Successfully"]);
            }
        } else {
            return response()->json(['status' => "Login to Continue"]);
        }
    }
    public function updatecart(Request $request)
    {
        $productid = $request->input('productid');
        $productquant = $request->input('productquantity');

        if (Auth::check()) {
            if (Cart::where('productid', $productid)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('productid', $productid)->where('user_id', Auth::id())->first();
                $cart->productquantity = $productquant;
                $cart->update();
                return response()->json(['status' => "Quantity updated"]);
            }
        }
    }
    public function cartcount()
    {
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }
}
