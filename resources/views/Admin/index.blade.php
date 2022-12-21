@extends('layouts.admin')
@section('title', 'Dashboard | Laravel Ecommerce')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header py-3">
        <h2 class="card-title mb-0">Dashboard</h2>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@if (session('status')) 
<script>    
  Swal.fire({
    // position: 'top-end',
    icon: 'success',
    showConfirmButton: false,
    timer: 2000,
    title: '{{ session("status") }}',
  })
</script>
@endif
@endsection