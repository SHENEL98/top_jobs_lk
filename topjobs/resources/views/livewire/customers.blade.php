<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="row">
        @include('livewire.customer_create')
        @include('livewire.customer_update')
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
                    <th>Customer Nname</th>
                    <th>Address</th>
                    <th>Phone number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>
                            <button data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $customer->id }})"
                                class="btn btn-primary  ">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
