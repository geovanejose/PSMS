@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Update Request
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
    <form method="post" action="{{ route('pedidos.update', $pedido->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Quantidade:</label>
              <input type="number" class="form-control" name="quantidade" min="1" max="10000" value="{{ $pedido->quantidade }}"/>
          </div>
          <input type="hidden"  name="user_id" value="{{ Auth::user()->id }}">
          <input type="hidden"  name="product_id" value="{{$pedido->id }}">
          <button type="submit" class="btn btn-primary">Update Request</button>
      </form>
  </div>
</div>
@endsection