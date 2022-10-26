<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="user_id">
                        <label for="exampleFormControlInput1">Customer Name</label>
                        <input type="text" class="form-control" wire:model="customer_name" id="exampleFormControlInput1" placeholder="Enter Name">
                        @error('customer_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Customer Contact Number</label>
                        <input type="tel" pattern="[1-9]\d+" minlength="11" maxlength="15" class="form-control" wire:model="phone_number" id="exampleFormControlInput2" placeholder="Enter price">
                        @error('phone_number') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Customer Address</label>
                        <textarea class="form-control" wire:model="address" id="exampleFormControlInput2" placeholder="Enter Address"></textarea>
                        @error('text') <span class="text-danger">{{ $message }}</span>@enderror
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>