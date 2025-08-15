@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Productos</h4>
    <div>
      <a class="btn btn-sm btn-success" href="/export/products">Exportar CSV</a>
      <a class="btn btn-sm btn-outline-secondary" href="/">Volver</a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead><tr><th>ID</th><th>Imagen</th><th>Nombre</th><th>SKU</th><th>Precio</th></tr></thead>
      <tbody>
        @foreach ($products as $p)
          <tr>
            <td>{{ $p['id'] }}</td>
            <td>@if($p['image']) <img src="{{ $p['image'] }}" alt="" style="height:40px"> @endif</td>
            <td>{{ $p['name'] }}</td>
            <td>{{ $p['sku'] }}</td>
            <td>{{ $p['price'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
