<div class="container-fluid">
    <button type="button" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#exampleModal">
        Add Customer
    </button>
</div>

<!-- Modal -->
<div wire:ignore class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Customer Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="Enter Customer Name" wire:model="customer_name">
                        @error('customer_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror

                        <label for="phone_number">Customer Contact Nmber</label>
                        <input type="text" class="form-control" id="phone_number"
                            wire:model="phone_number" placeholder="Enter Customer Nmber">
                        <small class="form-text text-muted">
                            Minimum 10 digits. eg: 94112334455
                        </small>
                        @error('phone_number')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" placeholder="Enter Address" wire:model="address"></textarea>
                        @error('address')
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
