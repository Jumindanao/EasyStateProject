<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    public function add()
    {
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }
    public function insert(Request $request)
    {
        $products = new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/uploads/products/', $filename);
            $products->image = $filename;
        }
        $products->categoryid = $request->input('categoryid');
        $products->prodname = $request->input('prodname');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->quantity = $request->input('quantity');
        $products->tax = $request->input('tax');
        $products->status = $request->input('status') == TRUE ? '1' : '0';//if true butang 1 if false zero;
        $products->trending = $request->input('trending') == TRUE ? '1' : '0';//if true butang 1 if false zero;
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_description = $request->input('meta_description');
        $products->save();
        return redirect('products')->with('status', "Product is Added Successfully");
    }

    public function edit($id)
    {
        $products = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit', compact('products', 'category'));
    }

    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/products/' . $products->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/uploads/products/', $filename);
            $products->image = $filename;
        }
        $products->prodname = $request->input('prodname');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->quantity = $request->input('quantity');
        $products->tax = $request->input('tax');
        $products->status = $request->input('status') == TRUE ? '1' : '0';//if true butang 1 if false zero;
        $products->trending = $request->input('trending') == TRUE ? '1' : '0';//if true butang 1 if false zero;
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_description = $request->input('meta_description');
        $products->update();
        return redirect('products')->with('status', "Property updated Successfully");
    }

    public function destroy($id)
    {
        $products = Product::find($id);
        $path = 'assets/uploads/products/' . $products->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $products->delete();
        return redirect('products')->with('status', "Property deleted Successfully");
    }

}
