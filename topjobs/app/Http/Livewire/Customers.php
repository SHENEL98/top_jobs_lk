<?php

namespace App\Http\Livewire;
use App\Models\Customer;

use Livewire\Component;

class Customers extends Component
{
    public $customers, $customer_name, $address,$phone_number,$customer_id;
    public $updateMode = false;

    public function render()
    {
        $this->customers = Customer::get();
        return view('livewire.customers');
    }
    private function resetInputFields(){
        $this->customer_name = '';
        $this->phone_number = '';
        $this->address = ''; 


    }
    public function store()
    { 
        $validatedDate = $this->validate([
            'customer_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric', 

        ]); 
        $customer = new Customer();

        $customer->customer_name = $this->customer_name;
        $customer->phone_number = $this->phone_number;
        $customer->address = $this->address; 

        $customer->save();
 
        session()->flash('message', 'Customer Created Successfully.');

        $this->resetInputFields();

        $this->emit('sellerStore'); // Close model to using to jquery
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $customer = Customer::where('id',$id)->first();
        $this->customer_id = $id;
        $this->customer_name = $customer->customer_name;
        $this->phone_number = $customer->phone_number;
        $this->address = $customer->address; 


     }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    public function update()
    {
        $validatedDate = $this->validate([
            'customer_name' => 'required',
            'phone_number' => 'required|numeric|min:10',
            'address' => 'required',

        ]);
        if ($this->customer_id) {

            $customer = Customer::find($this->customer_id);
            $customer->update([
                'customer_name' => $this->customer_name,
                'phone_number' => $this->phone_number,
                'address' => $this->address, 


            ]);
            $this->updateMode = false;
            session()->flash('message', 'Customer Updated Successfully.');
            $this->resetInputFields();
        }
    }
}
