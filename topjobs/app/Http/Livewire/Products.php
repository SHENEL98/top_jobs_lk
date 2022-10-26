<?php

namespace App\Http\Livewire; 
use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    
    public $products, $product_name,$product_code, $price,$expired_at,$status,$product_id;
    public $updateMode = false;

    public function render()
    {
        // dump($this->sellerId);
        $this->products = Product::get();
 
        return view('livewire.products');
    }
    private function resetInputFields(){
        $this->product_name = '';
        $this->product_code = '';
        $this->price = ''; 
        $this->expired_at = '';
        $this->status = '';


    }
    public function store()
    { 
        $validatedDate = $this->validate([
            'product_name' => 'required',
            'product_code' => 'required', 
            'price' => 'required|numeric', 

        ]); 
        $product = new Product();

        $product->product_name = $this->product_name;
        $product->product_code = $this->product_code;
        $product->price = $this->price; 
        $product->expired_at = $this->expired_at; 

        if($product->save()){
 
        session()->flash('message', 'Product Created Successfully.');
        $this->resetInputFields(); 
        }else{
            session()->flash('message', 'yolo.');
            $this->resetInputFields(); 
        }
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $product = Product::where('id',$id)->first();
        $this->product_id = $id;
        $this->status = $product->status;
        $this->product_name = $product->product_name;
        $this->product_code = $product->product_code;
        $this->price = $product->price; 
        $this->expired_at = $product->expired_at;


     }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    public function update()
    {
        $validatedDate = $this->validate([
            'product_name' => 'required',
            'product_code' => 'required', 
            'price' => 'required|numeric', 
        ]);
        if ($this->product_id) {
            $product = Product::find($this->product_id);
            $product->update([
                'product_name' => $this->product_name,
                'product_code' => $this->product_code,
                'price' => $this->price, 
                'expired_at' => $this->expired_at,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Product Updated Successfully.');
            $this->resetInputFields();
        }
    }
    public function deactive()
    {
        if ($this->product_id) {
    
        $product = Product::find($this->product_id);
      
        $product->update([
            'status' => "Deactive", 
        ]);
        $this->updateMode = false;
        $this->resetInputFields();
 
        session()->flash('message', 'Products Deactived Successfully.');
    }
            
    }
    public function active()
    {
        if ($this->product_id) {
            $product = Product::find($this->product_id);
    
            $product->update([
                'status' => "Active", 
            ]);
            $this->updateMode = false;
            $this->resetInputFields();
            session()->flash('message', 'Products Actived Successfully.');
        }
    }

}
