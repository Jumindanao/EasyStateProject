<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    public function index()
    {
        $featured_products = Product::where('trending', '1')->take(15)->get();
        $trending_category = Category::where('popular', '1')->take(15)->get();
        return view('frontend.index', compact('featured_products', 'trending_category'));
    }

    public function category()
    {
        $category = Category::where('status', '0')->get();
        return view('frontend.category', compact('category'));
    }

    public function viewcategory($name)
    {
        if (Category::where('name', $name)->exists()) {
            $category = Category::where('name', $name)->first();
            $products = Product::where('categoryid', $category->id)->where('status', '0')->get();
            return view('frontend.products.index', compact('category', 'products'));
        } else {
            return redirect('/')->with('status', "Name does not exist");
        }
    }

    public function productview($cate_name, $prod_name)
    {
        if (Category::where('name', $cate_name)->exists()) {
            if (Product::where('prodname', $prod_name)->exists()) {
                $products = Product::where('prodname', $prod_name)->first();
                $ratings = Rating::where('productid', $products->id)->get();
                $allrating = Rating::where('productid', $products->id)->sum('stars');
                $user_rating = Rating::where('productid', $products->id)->where('user_id', Auth::id())->first();
                $reviews = Review::where('prod_id', $products->id)->get();
                if ($ratings->count() > 0) {
                    $ratingvalue = $allrating / $ratings->count();
                } else {
                    $ratingvalue = 0;
                }

                return view('frontend.products.view', compact('products', 'ratings', 'reviews', 'ratingvalue', 'user_rating'));
            } else {
                return redirect('/')->with('status', "The link was broken");
            }
        } else {
            return redirect('/')->with('status', "No such category found");
        }
    }
    public function searchajax()
    {
        $theproducts = Product::select('prodname')->where('status', '0')->get();
        $data = [];

        foreach ($theproducts as $items) {
            $data[] = $items['prodname'];
        }
        return $data;
    }
    public function SearchProduct(Request $request)
    {
        $searchprod = $request->theproduct_name;

        if ($searchprod != "") {
            $product = Product::where("prodname", "LIKE", "%$searchprod%")->first();
            if ($product) {
                return redirect('category/' . $product->category->name . '/' . $product->prodname);
            } else {
                return redirect()->back()->with("status", "Sorry We do not have that product you are searching");
            }
        } else {
            return redirect() - back();
        }
    }
}
