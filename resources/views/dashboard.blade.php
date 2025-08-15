@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Dashboard</h4>
    <div><a class="btn btn-outline-secondary" href="/logout">Logout</a></div>
  </div>
  <div class="row g-3">
    <div class="col-md-6">
      <a class="card card-body text-decoration-none" href="/products">
        <h5 class="mb-1">Productos</h5>
        <small>Ver lista desde WooCommerce</small>
      </a>
    </div>
    <div class="col-md-6">
      <a class="card card-body text-decoration-none" href="/orders">
        <h5 class="mb-1">Pedidos</h5>
        <small>Últimos 30 días</small>
      </a>
    </div>
  </div>
</div>
@endsection
