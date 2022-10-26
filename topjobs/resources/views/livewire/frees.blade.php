<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="row">
        @include('livewire.free_create')
        @include('livewire.free_update')
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
                    <th>Free Issue lable</th>
                    <th>Type</th>
                    <th>Product Name</th>
                    <th>Lower Limit</th>
                    <th>Upper Limit</th>
                    <th>Free Qunatity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($frees as $free)
                    <tr>
                        <td>{{ $free->id }}
                        <td>{{ $free->label }}
                            <br>
                            @if($free->status == "Active")
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Deactive</span>
                            @endif
                        </td>
                        <td>{{ $free->type }}</td>
                        <td>{{ $free->product_id }}</td>
                        <td>{{ $free->lower_limit }}</td>
                        <td>{{ $free->upper_limit }}</td>
                        <td>{{ $free->free_qty }}</td>
                        <td>
                            <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $free->id }})"
                                class="btn btn-primary  ">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
