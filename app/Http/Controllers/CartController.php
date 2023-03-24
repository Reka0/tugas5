<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('cart')->leftjoin('product', 'cart.product_id','=','product_id')->select(['cart.*','product.product_name' ])->get();
        return view('cart.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = User::all();
        $product = Product::all();
        return view('cart.add', ['customer' => $customer,'product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_id' => 'required',
            'stock' => 'required',
            'customer_id' => 'required',
        ]);
        $data_produk = Product::where(['id' => $request->product_id])->first();
        $insert = Cart::create([
            'stock' => $request->stock,
            'price' => $data_produk->price * $request->stock,
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
        ]);
        if ($insert) {
            return redirect('cart');
        }else{
            return redirect('create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $data = DB::table('cart')->join('users', 'cart.customer_id','=','users.id')->join('product', 'cart.product_id','=','product .id')->select(['cart.*','product.product_name',])->first();
        $customer = User::all();
        $product = Product::all();
        return view('cart.edit',['data' => $data,'customer' => $customer,'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'product_id' => 'required',
            'stock' => 'required',
            'customer_id' => 'required',
        ]);
        $data_product = Product::where(['id' => $request->product])->first();
        $update = Cart::where(['id'=> $id])->update([
            'stock' => $request->stock,
            'price' => $data_product->harga_produk * $request->stock,
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
        ]);
            return redirect('cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $delete = Cart::find($id)->delete();
        return redirect('/cart');
    }
}
