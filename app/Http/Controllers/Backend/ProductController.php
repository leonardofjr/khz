<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\ProductCat;
use Auth;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $product = User::where('id', Auth::user()->id)->with('products.product_cats')->paginate(1);
     //  $product = Product::where('id', Auth::user()->id)->with('products.product_cats')->get(1);
     $product = Product::with('product_cats')->get();
     
     return $product;

    }
    public function cats()
    {
        $product_cats = ProductCat::all();
        return $product_cats;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        if ($request) {
            $product = new Product;
            $product->name = $request->input('name');
            $product->sku = $request->input('sku');
            $product->stock_status = $request->input('stockStatus');
            $product->slug = $request->input('slug');
            $product->details = $request->input('details');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->tags = $request->input('tags');
            $product->user_id = Auth::id();
            $product->save();
            foreach ($request->input('cats') as $key => $cat) {
                $product->product_cats()->attach(ProductCat::where('name', $cat)->first()); 
            }
            
            return response()->json($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
