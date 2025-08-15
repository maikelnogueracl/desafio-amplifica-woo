@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width:420px">
  <h3 class="mb-3">Login</h3>
  @if ($errors->any())
    <div class="alert alert-danger">
      {{ $errors->first() }}
    </div>
  @endif
  <form method="POST" action="/login">
    @csrf
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input name="email" type="email" class="form-control" value="{{ old('email') }}" required />
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input name="password" type="password" class="form-control" required />
    </div>
    <button class="btn btn-primary w-100">Entrar</button>
  </form>
</div>
@endsection
