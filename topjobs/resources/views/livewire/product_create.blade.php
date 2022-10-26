<div class="container-fluid">
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
    Add Product
</button>
</div>

<!-- Modal -->
<div wire:ignore class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name"
                            placeholder="Enter Product Name" wire:model="product_name" required>
                        @error('product_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_code">Product Code</label>
                        <input type="text" class="form-control" id="product_code"
                            placeholder="Enter Product Code" wire:model="product_code" required>
                        @error('product_code')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" class="form-control" id="price" wire:model="price"
                            placeholder="Enter Product Price" required>
                        @error('price')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div> 
                    <div class="form-group">
                        <label for="expired_at">Expired On</label>
                        <input type="date" class="form-control" id="expired_at"
                            wire:model="expired_at" required>
                        @error('expired_at')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Add New
                    Product</button>
            </div>
        </div>
    </div>
</div>
