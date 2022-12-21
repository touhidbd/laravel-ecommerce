@section('title', 'Colors | eCommerce')
<div>
    @include('livewire.admin.color.modal-form')

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('status')) 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("status") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="cart-title m-0">Colors</h4>
                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#colorModal">Add Color</a>
                </div>
                <div class="card-body">  
                    <div wire:loading>
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="spinner-border text-warning" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="ms-2">Loading...</div>
                        </div>
                    </div>
                    <div wire:loading.remove>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Color Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($colors as $color)
                                    <tr class="{{$color->status == '1' ? 'table-danger':''}}">
                                        <td>{{ $color->name }}</td>
                                        <td>
                                            <div class="d-flex color-item align-items-center">
                                                <div class="spinner-grow me-2" role="status" style="background-color: {{$color->code}}">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                {{ $color->code }}
                                            </div>
                                        </td>
                                        <td>{{ $color->status == '1' ? 'Hidden':'Visible' }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success text-white" data-bs-toggle="modal" data-bs-target="#updateColorModel" wire:click="editColor({{$color->id}})">Edit</a>
                                            <a href="#" wire:click="deleteColor({{$color->id}})" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal" data-bs-target="#deleteColorModel">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4 justify-content-center">
                                {{ $colors->links() }}
                            </div>
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
            $('#colorModal,#updateColorModel,#deleteColorModel').modal('hide');
        });
    </script>
@endpush