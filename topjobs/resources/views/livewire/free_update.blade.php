<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Free Issues lable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
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
                        <label for="exampleFormControlInput2">Type</label> <small> Selected :
                            {{ $type }}</small>
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
                            @if ($products)
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ $product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}
                                    </option>
                                @endforeach
                            @else
                                <option value="">No product yet
                                <option>
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
                        <input type="text" class="form-control" id="free_qty" wire:model="free_qty"
                            placeholder="Enter Free Quntity">
                        @error('free_qty')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                @if ($status == 'Active')
                    <button type="button" wire:click.prevent="deactive()" class="btn btn-danger"
                        data-dismiss="modal">Deactive</button>
                @else
                    <button type="button" wire:click.prevent="active()" class="btn btn-success"
                        data-dismiss="modal">Active</button>
                @endif
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
