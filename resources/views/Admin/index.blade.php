@extends('layouts.admin')
@section('title', 'Dashboard | Laravel Ecommerce')

@section('content')
<div class="row mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header py-3">
        <h2 class="card-title mb-0"><i class="mdi mdi-chart-bar menu-icon"></i> Orders</h2>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="card card-body bg-primary text-white mb-3">
      <label>Total Orders</label>
      <h1>{{ $totalOrders }}</h1>
      <a href="{{ url('admin/orders') }}" class="text-white">view</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-body bg-success text-white mb-3">
      <label>Today Orders</label>
      <h1>{{ $todayOrders }}</h1>
      <a href="{{ url('admin/orders') }}" class="text-white">view</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-body bg-warning text-white mb-3">
      <label>This Month Orders</label>
      <h1>{{ $thisMonthOrders }}</h1>
      <a href="{{ url('admin/orders') }}" class="text-white">view</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-body bg-danger text-white mb-3">
      <label>This Year Orders</label>
      <h1>{{ $thisYearOrders }}</h1>
      <a href="{{ url('admin/orders') }}" class="text-white">view</a>
    </div>
  </div>
</div>
<div class="row mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header py-3">
        <h2 class="card-title mb-0"><i class="mdi mdi-cart menu-icon"></i> Products</h2>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="card card-body bg-secondary text-white mb-3">
      <label>Total Products</label>
      <h1>{{ $totalProducts }}</h1>
      <a href="{{ url('admin/products') }}" class="text-white">view</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-body bg-info text-white mb-3">
      <label>Total Categories</label>
      <h1>{{ $totalCategories }}</h1>
      <a href="{{ url('admin/category') }}" class="text-white">view</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-body bg-dark text-white mb-3">
      <label>Total Brands</label>
      <h1>{{ $totalBrands }}</h1>
      <a href="{{ url('admin/brands') }}" class="text-white">view</a>
    </div>
  </div>
</div>
<div class="row mb-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header py-3">
        <h2 class="card-title mb-0"><i class="mdi mdi-account menu-icon"></i> Users</h2>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="card card-body alert alert-success mb-3">
      <label>All Users</label>
      <h1>{{ $totalAllUsers }}</h1>
      <a href="{{ url('admin/users') }}" class="text-success">view</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-body alert alert-danger mb-3">
      <label>Total Admin</label>
      <h1>{{ $totalAdmins }}</h1>
      <a href="{{ url('admin/users') }}" class="text-danger">view</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card card-body alert alert-warning mb-3">
      <label>Total User</label>
      <h1>{{ $totalUsers }}</h1>
      <a href="{{ url('admin/users') }}" class="text-warning">view</a>
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