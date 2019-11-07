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
  <h2 class="text-center">Products</h2><br>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td>Description</td>
          <td>User-id</td>

          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->user_id}}</td>
            <td><a href="{{ route('products.edit', $product->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('products.destroy', $product->id)}}" method="post">
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
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Requets
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('pedidos.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Quantidade:</label>
              <input type="number" class="form-control" min="1"  max="10000" name="quantidade"/>
          </div>
          <div class="form-group">
            <label for="product_id">Disciplina</label>
            <select class="form-control" name="product_id" required>
                <option disabled selected>Select Product</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

          <input type="hidden"  name="user_id" value="{{ Auth::user()->id }}">
          <button type="submit" class="btn btn-primary">Create Request</button>
      </form>
  </div>
</div>
@endsection