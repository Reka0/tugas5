<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('product')->join('category', 'product.category_id', '=', 'category_id')->get();
        // ->join('users', 'product.seller_id','=','users.id')
        return view('product.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $seller = User::all();
        $category = Category::all();
        return view('product.create', [ 'category' => $category]);
        // 'seller' => $seller,
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
            'product_name' => 'required',
            'photo' => 'required',
            'description' => 'required',
            'price' => 'required',
            // 'seller_id' => 'required',
            'category_id' => 'required'
        ]);

        $photo = $request->file('photo')->store('product', 'public');
        $insert = Product::create([
            'product_name' => $request->product_name,
            'photo' => $photo,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            // 'seller_id' => $request->seller_id,
            'category_id' => $request->category_id
        ]);
        if ($insert) {
            return redirect('product');
        }else{
            return redirect('create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $data = DB::table('product')->join('category', 'product.category_id','=','category.id')->where(['product.id'=>$id])->first();
        // ->join('users', 'product.seller_id','=','users.id')
        // $seller = User::all();
        $category = Category::all();
        return view('product/edit',['data' => $data,'category' => $category]);
        // 'seller' => $seller,
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'product_name' => 'required',
            'photo' => 'required',
            'description' => 'required',
            'price' => 'required',
            // 'seller_id' => 'required',
            'category_id' => 'required'
        ]);
        if ($request->photo != null) {
            $data_image = Product::where(['id' => $id])->first();
            if (File::exists($data_image->product_name)) {
                File::delete($data_image-> product_name);
            }
            $photo= $request->file('photo')->store('produk', 'public');
            $update = Product::where(['id'=> $id])->update([
            'product_name' => $request->product_name,
            'photo' => $photo,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            // 'seller_id' => $request->seller_id,
            'category_id' => $request->category_id            ]);
        }else{
            $update = Product::where(['id'=> $id])->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            // 'seller_id' => $request->seller_id,
            'category_id' => $request->category_id
        ]);
        }
        if ($update) {
            return redirect('product');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $delete = Product::find($id)->delete();
        return redirect('/product');

    }
}
