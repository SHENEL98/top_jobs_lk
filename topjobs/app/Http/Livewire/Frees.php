<?php

namespace App\Http\Livewire;
use DB;
use App\Models\Free;
use App\Models\Product;
use Carbon\Carbon;

use Livewire\Component;

class Frees extends Component
{
    public $label, $type, $free_qty,$product_id,$lower_limit,$upper_limit,$status ,$free_id,$today;
    public $updateMode = false;
    public $products =[];
    public $frees =[];

    public function render()
    {
        $this->today = Carbon::now();
        $this->products = Product::where('status',"Active")
                    ->where('expired_at','>',$this->today)->get();
        $this->frees = Free::get();

        return view('livewire.frees');
    }
    private function resetInputFields(){
        $this->label = '';
        $this->type = '';
        $this->free_qty = ''; 
        $this->product_id  = '';
        $this->lower_limit  = '';
        $this->upper_limit  = '';
        $this->status = '';

    }
    public function store()
    { 
        $validatedDate = $this->validate([
            'label' => 'required',
            'type' => 'required', 
            'free_qty' => 'required|numeric', 
            'lower_limit' => 'required|numeric', 
            'upper_limit' => 'required|numeric', 

        ]); 
        
        if($this->lower_limit < $this->upper_limit)
        {
            $free = new Free();
            $free->label = $this->label;
            $free->type = $this->type;
            $free->free_qty = $this->free_qty; 
            $free->product_id  = $this->product_id ; 
            $free->lower_limit  = $this->lower_limit ; 
            $free->upper_limit  = $this->upper_limit ; 

            $free->save();
            session()->flash('message', 'Free Issue Type Created Successfully.');
            $this->resetInputFields();
        }  else{
            session()->flash('message', 'Add Right Limit range.');
            $this->resetInputFields();
        }
 
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $free = Free::where('id',$id)->first();
        $this->free_id = $id;
        $this->label = $free->label;
        $this->type = $free->type;
        $this->status = $free->status;

        $this->product_id = $free->product_id;
        $this->free_qty = $free->free_qty; 
        $this->lower_limit = $free->lower_limit; 
        $this->upper_limit = $free->upper_limit;


     }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    public function update()
    {
        $validatedDate = $this->validate([
            'label' => 'required',
            'type' => 'required', 
            'free_id' => 'required', 
            'free_qty' => 'required|numeric', 
            'lower_limit' => 'required|numeric', 
            'upper_limit' => 'required|numeric', 
        ]);
        if ($this->free_id) {
            if($this->lower_limit < $this->upper_limit){

                $free = Free::find($this->free_id);
                $free->update([
                    'label' => $this->label,
                    'type' => $this->type,
                    'product_id' => $this->product_id,
                    'free_qty' => $this->free_qty, 
                    'lower_limit' => $this->lower_limit,
                    'upper_limit' => $this->upper_limit,
                ]);
                $this->updateMode = false;
                session()->flash('message', 'Free label Updated Successfully.');
                $this->resetInputFields();
            }
            else{
                session()->flash('message', 'Add Right Limit range.');
                $this->resetInputFields();
            }
        }
    }
   
    public function deactive()
    {
        if ($this->free_id) {
    
            $free = Free::find($this->free_id);
            $free->update([
            'status' => "Deactive", 
        ]);
        $this->updateMode = false;
        $this->resetInputFields();
 
        session()->flash('message', 'Products Deactived Successfully.');
    }
            
    }
    public function active()
    {
        if ($this->free_id) {
            $free = Free::find($this->free_id);
            $free->update([
                'status' => "Active", 
            ]);
            $this->updateMode = false;
            $this->resetInputFields();
            session()->flash('message', 'Products Actived Successfully.');
        }
    }
}
