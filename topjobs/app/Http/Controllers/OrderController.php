<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Free;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use DB;
use PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function add_cart(Request $request)
    { 
        $product = Free::join('products','products.id','frees.product_id')
                    ->where('products.id',$request->product_id)
                    ->where('frees.lower_limit','<',$request->qty)
                    ->where('frees.upper_limit','>',$request->qty)
                    ->select('frees.label','frees.id as free_id','frees.free_qty','products.id as product_id','products.product_name','products.product_code','products.price')
                    ->get(); 
        
        if(sizeof($product)){
            $cart = \Session::get('cart');
            $request->session()->put('thi',$cart);
            if (!$cart) {
                $cart = [
                    $product[0]->product_id => [
                        "product_id" => $product[0]->product_id,
                        "free_id" => $product[0]->free_id, 
                        "product_name" => $product[0]->product_name, 
                        "product_code" => $product[0]->product_code,  
                        "price" => $product[0]->price,
                        "free_qty" => $product[0]->free_qty, 
                        "label" => $product[0]->label, 
                        "qty" => $request->qty
                    ]
                ];
                \Session::put('cart', $cart);
            } elseif (isset($cart[$product[0]->product_id])) {

                $cart[$product[0]->product_id]['qty'] += $request->qty;
                \Session::put('cart', $cart);

            } else {
                $cart[$product[0]->product_id] = [
                    "product_id" => $product[0]->product_id,
                    "free_id" => $product[0]->free_id, 
                    "product_name" => $product[0]->product_name, 
                    "product_code" => $product[0]->product_code,  
                    "price" => $product[0]->price,
                    "free_qty" => $product[0]->free_qty, 
                    "label" => $product[0]->label, 
                    "qty" => $request->qty
                ];
                \Session::put('cart', $cart);
            }

        $respose['status'] = 200;
        $respose['message'] = 'Successfully Added to the cart';
        $respose['CART'] = session('cart');
        }else {
            $respose['status'] = 500;
        } 

        // dd($respose['status']);
        echo json_encode($respose); 
    }

    public function checkout_index()
    {
        $customers = Customer::get();
        return view('checkout')->with(['customers'=>$customers]);
    }
    function getcart()
    {
         $respose['CARTView'] = session()->get('cart'); 
        echo json_encode($respose['CARTView']);
    }
    public function remove_cart(Request $request){

        $respose = array();
        $cart = session()->get('cart');
        $respose['cart1'] = $cart;

        if($request->product_id) {
                unset($cart[$request->product_id]);

                session()->put('cart', $cart);
                $cart = session()->get('cart'); 

                $respose['status'] = 200; 
                $respose['message'] = 'Successfully removed';               
         
        }else{
            $respose['status2'] = 500;
        }


        echo json_encode($respose);

    }

    function allremove_cart(Request $request){

        $respose = array();
        $cart = session()->get('cart');
        $request->session()->flush();

        $respose['status'] = 200;
        $respose['message'] = 'Successfully removed';
               
        echo json_encode($respose);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();
        // dd($orders);
        return view('order_list')->with(['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function place_order(Request $request)
    {
         $order = new Order();
         $order->customer_id = $request->customer_id;
         $order->net_total = $request->amount_total;
        //  $order->save();
 

         $respose['CART'] = session('cart');

         if ($order->save()) {
             $cart_items = session()->get('cart');
 
             foreach ($cart_items as $cart_item) {
                 $oid = $order->id;
                 
                 $order_product = new OrderProduct();
                 $order_product->order_id = $order->id; 
                 $order_product->product_id = $cart_item['product_id'];
                 $order_product->free_id = $cart_item['free_id']; 

                 $order_product->qty = $cart_item['qty'];
                 $order_product->free_qty = $cart_item['free_qty'];
                 $order_product->unit_price = $cart_item['price'];
                 $order_product->amount = $cart_item['price'] * $cart_item['qty'];
                 $order_product->save();
             }
             $order_details = DB::table('orders')->join('customers','customers.id','orders.id')
                            ->where('orders.id', '=', $order->id)
                            ->select('orders.id as order_id','orders.net_total','customers.*')
                            ->get();
          
             $response['status'] = 200;
             $response['data'] = $order_details; 
 
             $request->session()->flush();
  
         } else {
             $response['status'] = 500;
             $response['message'] = 'Please try again later.!!';
         }
         echo json_encode($response); 
    }

    public function invoice(Request $request)
    {
        $id = $request->id;

        $order = Order::where('id', '=', $id)->get();
        $ordertot = Order::where('orders.id', '=', $id)
            ->select('orders.net_total')
            ->get(); 
        $order_products = OrderProduct::where('order_id', '=', $id)->get();
        $pdf = PDF::loadView('pdf.pdf', compact('order', 'ordertot', 'order_products'));
        return $pdf->download('Test - Invoice');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order_products =OrderProduct::where('order_id',$order->id)->get();

        return view('order_show')->with(['order'=>$order,'order_products'=>$order_products]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
