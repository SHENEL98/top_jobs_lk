<div class="container-fluid">
    <button type="button" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#exampleModal">
        Add Free Tssue
    </button>
</div>

<!-- Modal -->
<div wire:ignore class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Free Issues lable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="label">Freeissue lable</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="Enter Customer Name" wire:model="label">
                        @error('label')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Type</label>
                        <select class="form-control" name='type' id="type" wire:model.defer="type">
                            <option value="">--Free Issue Types--</option>
                            <option value="Flat">Flat</option>
                            <option value="Multiple">Multiple</option>
                        </select>
                        @error('type')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Product</label>
                        <select class="form-control" name='product_id' id="product_id" wire:model.defer="product_id">
                            <option value="">--Select Product --</option>
                            @if ($products)
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            @else
                                <option value="">No product yet<option>
                            @endif
                        </select>
                        @error('product_id')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lower_limit">Lower limit</label>
                        <input type="text" class="form-control" id="lower_limit" wire:model="lower_limit"
                            placeholder="Enter Lower limit">
                        @error('lower_limit')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror

                        <label for="upper_limit">Upper limit</label>
                        <input type="text" class="form-control" id="upper_limit" wire:model="upper_limit"
                            placeholder="Enter Upper limit">
                        @error('upper_limit')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="free_qty">Free Quntity</label>
                        <input type="text" class="form-control" id="free_qty"
                            wire:model="free_qty" placeholder="Enter Free Quntity">
                        @error('free_qty')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Add New
                    Customer</button>
            </div>
        </div>
    </div>
</div>
