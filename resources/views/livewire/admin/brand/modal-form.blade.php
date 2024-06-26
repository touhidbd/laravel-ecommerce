<!--Add Modal-->
<div wire:ignore.self id="brandModal" class="modal fade" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form wire:submit.prevent="storeBrand" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Brands</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="mb-2" for="name">Brand Name</label>
                        <input class="form-control" type="text" id="name" wire:model.defer="name">
                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="category">Category</label>
                        <select wire:model.defer="category_id" id="category" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="image">Brand Image</label>
                        <input class="form-control" type="file" id="image" wire:model.defer="image">
                        @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input" id="status" wire:model.defer="status">
                            <label class="custom-control-label" for="status">Hidden</label>
                            @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary text-white">Add Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Modal-->
<div wire:ignore.self id="updateBrandModal" class="modal fade" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">    
            <div wire:loading>
                <div class="d-flex align-items-center justify-content-center p-5">
                    <div class="spinner-border text-warning" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="ms-2">Loading...</div>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Brands</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="mb-2" for="name">Brand Name</label>
                            <input class="form-control" type="text" id="name" wire:model.defer="name">
                            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="category">Category</label>
                            <select wire:model.defer="category_id" id="category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="slug">Brand Slug</label>
                            <input class="form-control" type="text" id="slug" wire:model.defer="slug">
                            @error('slug')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="image">Brand Image</label>
                            <input class="form-control" type="file" id="image" wire:model.defer="image">
                            @if ($image)
                                <img width="150" src="{{ asset('storage/brand/'.$image) }}" alt="">
                            @endif
                            
                            @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" class="custom-control-input" id="status" wire:model.defer="status">
                                <label class="custom-control-label" for="status">Hidden</label>
                                @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-white">Update Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Delete Modal-->
<div wire:ignore.self id="deleteBrandModal" class="modal fade" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">   
            <div wire:loading>
                <div class="d-flex align-items-center justify-content-center p-5">
                    <div class="spinner-border text-warning" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="ms-2">Loading...</div>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Do you want to delete this brand?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-white">Delete Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>