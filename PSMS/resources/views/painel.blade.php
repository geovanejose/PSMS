@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Quantidade</td>
          <td>Product-id</td>
          <td>User-id</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{$pedido->quantidade}}</td>
            <td>{{$pedido->product_id}}</td>
            <td>{{$pedido->user_id}}</td>
            <td><a href="{{ route('pedidos.edit', $pedido->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('pedidos.destroy', $pedido->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection