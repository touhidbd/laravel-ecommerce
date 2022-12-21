<!--Add Modal-->
<div wire:ignore.self id="colorModal" class="modal fade" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form wire:submit.prevent="storeColor">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Color</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="mb-2" for="name">Name</label>
                        <input class="form-control" type="text" id="name" wire:model.defer="name">
                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="code">Color Code</label><br>
                        <input type="color" id="code" wire:model.defer="code">
                        @error('code')<small class="text-danger">{{ $message }}</small>@enderror
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
                    <button type="submit" class="btn btn-primary text-white">Add Color</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Modal-->
<div wire:ignore.self id="updateColorModel" class="modal fade" data-bs-backdrop="static">
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
                <form wire:submit.prevent="updateColor">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Color</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="mb-2" for="name">Name</label>
                            <input class="form-control" type="text" id="name" wire:model.defer="name">
                            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2" for="code">Color Code</label><br>
                            <input type="color" id="code" wire:model.defer="code">
                            @error('code')<small class="text-danger">{{ $message }}</small>@enderror
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
                        <button type="submit" class="btn btn-primary text-white">Update Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Delete Modal-->
<div wire:ignore.self id="deleteColorModel" class="modal fade" data-bs-backdrop="static">
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
                <form wire:submit.prevent="destroyColor">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Do you want to delete this color?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-white">Delete Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>