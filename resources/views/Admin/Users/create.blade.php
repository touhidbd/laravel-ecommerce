@extends('layouts.admin')
@section('title', 'Add User | Laravel Ecommerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="cart-title m-0">Add User</h4>
                <a href="{{ url('admin/users') }}" class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/users') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-input">
                                <label for="name" class="mb-2">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">                            
                            <div class="form-input">
                                <label for="email" class="mb-2">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-input">
                                <label for="password" class="mb-2">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                                @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">                            
                            <div class="form-input">
                                <label for="role_as" class="mb-2">Role</label>
                                <select name="role_as" id="role_as" class="form-control">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                @error('role_as')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>             
                    <button type="submit" class="btn btn-primary text-white">Add User</button>
                </form>
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