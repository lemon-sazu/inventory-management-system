<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProductSizeStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();

        // return $products;
        return view('products.index', compact('products'));
        // return var_dump($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:products',
            'name' => 'required|string|max:200',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:200',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'year' => 'required',
            'description' => 'required|max:200',
            'status' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product = new Product();
        $product-> user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;
// ssssave file is has 
        if($request->hasFile('image')){
            $image = $request->image;
            $name = Str::random(60) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/product_images', $name);
            $product->image = $name;
        }

        // save products
        $product->save();

        foreach (json_decode($request->items) as $item) {
            $size_stock = new ProductSizeStock();
            $size_stock->product_id = $product->id;
            $size_stock->size_id = $item->size_id;
            $size_stock->location = $item->location;
            $size_stock->quantity = $item->quantity;
            $size_stock->save();
        }

        flash('Product Created Successfully.')->success();

        return response()->json([
            'success' => true
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $products = Product::with(['category', 'brand', 'product_size_stock.size'])->where('id', $id)->first();
        return view('products.show',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $products = Product::where('id', $id)->with(['product_size_stock'])->first();
        return view('products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:products,sku,'.$id,
            'name' => 'required|string|max:200',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:200',
            'cost_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'year' => 'required',
            'description' => 'required|max:200',
            'status' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product = Product::findOrFail($id);
        $product-> user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->retail_price = $request->retail_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;
// ssssave file is has 
        if($request->hasFile('image')){
            Storage::delete('public/product_images/'. $product->image);
            $image = $request->image;
            $name = Str::random(60) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/product_images', $name);
            $product->image = $name;
        }

        // save products
        $product->save();
        // delete old datas and insert again 
        ProductSizeStock::where('product_id', $id)->delete();
        foreach (json_decode($request->items) as $item) {
            $size_stock = new ProductSizeStock();
            $size_stock->product_id = $product->id;
            $size_stock->size_id = $item->size_id;
            $size_stock->location = $item->location;
            $size_stock->quantity = $item->quantity;
            $size_stock->save();
        }

        flash('Product Updated Successfully.')->success();

        return response()->json([
            'success' => true
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        

            Storage::delete('public/product_images/'. $product->image);
            $product->delete();
            flash('Product Deleted Successfully.')->success();
            return back();


     
    }
}
