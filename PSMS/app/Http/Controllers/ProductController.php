<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check())
        {
          $products = Product::all();

          return view('index', compact('products'));
        }
        return redirect()->route('login');
    }

    /**
     * Product the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->check())
        {
         return view('create');
         }
         return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'user_id' => 'required',
        ]);
        $product = Product::create($validatedData);
   
        return redirect('/products')->with('success', 'Product is successfully saved');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::all();

     return view('index', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->check())
        {
             $product = Product::findOrFail($id);

         return view('edit', compact('product'));
        }
        return redirect()->route('login');
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
      $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'user_id' => 'required',
        ]);
        Product::whereId($id)->update($validatedData);

        return redirect('/products')->with('success', 'Product is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    if(auth()->check())
    {     
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product is successfully deleted');
    }
     return redirect()->route('login');
    
    }
}
