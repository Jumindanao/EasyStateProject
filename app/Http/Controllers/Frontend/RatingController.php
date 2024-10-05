<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function add(Request $request){
        $starrate=$request->input('product_rating');
        $product_id= $request->input('product_id');

        $product_check= Product::where('id',$product_id)->where('status','0')->first();
        if($product_check)
        {
            $verify_purchase= Order::where('orders.user_id',Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.productid',$product_id)->get();
            if($verify_purchase->count()>0)
            {
                $existedrating=Rating::where('user_id',Auth::id())->where('productid',$product_id)->first();
               
                if($existedrating)
                {
                    $existedrating->stars=$starrate;
                    $existedrating->save();
                }
                else{
                    Rating::create([
                        'user_id'=>Auth::id(),
                        'productid'=> $product_id,
                        'stars'=> $starrate
                    ]);
                }
                return redirect()->back()->with('status','Thank you for Rating This Product');
            }
            else
            {
                return redirect()->back()->with('status','product Must be purchased');
            }
        }
        else
        {
            return redirect()->back()->with('status','Something is wrong ');
        }
    }
}
