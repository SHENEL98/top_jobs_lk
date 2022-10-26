<div>
    {{-- Be like water. --}}
    <div class="row">
        @include('livewire.product_create')
        @include('livewire.product_update')
        <br>
        <div class="container-fluid">
            @if (session()->has('message'))
                <div class="alert alert-success" style="margin-top:30px;">x
                    {{ session('message') }}
                </div>
            @endif
        </div>



        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Price (Rs.)</th>
                    <th>Expired On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}
                            <br>  
                            @if($product->status == "Deactive")
                                <span class="badge badge-danger">Deactive </span>
                            @elseif($product->status == "Active")
                                <span class="badge badge-success">Active</span>
                            @endif
                        </td>
                        <td>{{ $product->product_code }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->expired_at)->isoFormat('YYYY MMM Do') }}</td>
                        <td>
                            <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $product->id }})"
                                class="btn btn-primary  ">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
