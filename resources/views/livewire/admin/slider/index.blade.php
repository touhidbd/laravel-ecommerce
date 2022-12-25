<div>    
    <div wire:ignore.self id="deleteModal" class="modal fade" data-bs-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="destroySlider">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Do you want to delete this slider?</h1>
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
                    <h4 class="cart-title m-0">Sliders</h4>
                    <a href="{{ url('/admin/add-slider') }}" class="btn btn-sm btn-info">Add Slider</a>
                </div>
                <div class="card-body">
                    @if ($sliders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                <tr class="{{$slider->status == '1' ? 'table-danger':''}}">
                                    <td>{{ $slider->title }}</td>
                                    <td><img src="{{ url('uploads/slider/'.$slider->image) }}" alt="{{ $slider->name }}"></td>
                                    <td>{{ $slider->status == '1' ? 'Hidden':'Visible' }}</td>
                                    <td>
                                        <a href="{{ url('/admin/slider/'.$slider->id.'/edit') }}" class="btn btn-sm btn-success text-white">Edit</a>
                                        <a href="#" wire:click="deleteSlider({{$slider->id}})" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 justify-content-center">
                            {{ $sliders->links() }}
                        </div>
                    </div>
                    @endif
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