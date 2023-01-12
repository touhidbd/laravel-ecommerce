<div>    
    <div wire:ignore.self id="deleteModal" class="modal fade" data-bs-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="destroyCategory">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Do you want to delete this user?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-white">Yes, Delete!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('status')) 
            <div class="alert alert-success" role="alert">
                {{ session("status") }}
            </div>
            @endif
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="cart-title m-0">Users</h4>
                    <a href="{{ url('/admin/add-user') }}" class="btn btn-sm btn-info">Add User</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role_as == 0 ? 'User':'Admin' }}</td>
                                    <td>
                                        <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" class="btn btn-sm btn-success text-white">Edit</a>
                                        <a href="#" wire:click="deleteUser({{$user->id}})" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush