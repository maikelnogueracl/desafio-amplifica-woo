@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Pedidos (últimos 30 días)</h4>
    <div>
      <a class="btn btn-sm btn-success" href="/export/orders">Exportar CSV</a>
      <a class="btn btn-sm btn-outline-secondary" href="/">Volver</a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead><tr><th>ID</th><th>Cliente</th><th>Fecha</th><th>Estado</th><th>Ítems</th></tr></thead>
      <tbody>
        @foreach ($orders as $o)
          <tr>
            <td>{{ $o['id'] }}</td>
            <td>{{ $o['customer'] }}</td>
            <td>{{ $o['date'] }}</td>
            <td>{{ $o['status'] }}</td>
            <td>
              @foreach ($o['items'] as $i)
                <div>{{ $i['name'] }} x{{ $i['quantity'] }}</div>
              @endforeach
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
