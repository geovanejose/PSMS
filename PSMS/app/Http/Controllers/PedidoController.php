<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;

class PedidoController extends Controller
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
          $pedidos = Pedido::all();

          return view('painel', compact('pedidos'));
        }
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->check())
        {
         return view('index');
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
        $validated = $request->validate([
            'quantidade' => 'required|min:1|max:10000|numeric',
            'product_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);
        $pedidos = Pedido::create($validated);
   
        return redirect('/pedidos')->with('success', 'Request is successfully saved');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->check())
        {
          $pedidos = Pedido::all();

            return view('index', compact('pedidos'));
        }
         return redirect()->route('login');
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
             $pedido = Pedido::findOrFail($id);

         return view('editar', compact('pedido'));
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
        $validated = $request->validate([
            'quantidade' => 'required|min:1|max:10000|numeric',
            'product_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);
        Pedido::whereId($id)->update($validated);

        return redirect('/pedidos')->with('success', 'Request is successfully updated');
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
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect('/pedidos')->with('success', 'Request is successfully deleted');
    }
     return redirect()->route('login');
    
    }
}
