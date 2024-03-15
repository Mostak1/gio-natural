<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function placeOrder(Request $request)
    {
        // Validate the incoming request data |email |regex:/^01\d{9}$/
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string',
            'customer_email' => 'required',
            'billing_address' => 'required|string',
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'message' => 'nullable|string',
            'subtotal' => 'required|numeric',
            'pay_method' => 'required',
            'invoice_number' => 'required|string|unique:orders,invoice_number',
        ]);
        
        if ($validator->fails()) {
            // Return a JSON response with validation errors
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create($validator->validated());

            // Associate order details with the order
            $cartDetails = $request->input('cartDetails');
            $orderDetails = [];

            foreach ($cartDetails as $cartItem) {
                $product = Product::find($cartItem['productId']);
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $product->id;
                $orderDetail->quantity = $cartItem['quantity'];
                $orderDetail->item_total = $product->price * $cartItem['quantity'];
                $orderDetail->save();
            }

           $orderId = $order->id;
            DB::commit();

            // Return a success response
            return response()->json(['success' => 'Order placed successfully', 'orderId' => $orderId], 200);

        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            // Return an error response
            return response()->json(['error' => 'Error placing order. ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     **/
    public function show(Order $order)
    {
        $orderProducts = OrderDetail::where('order_id', $order->id)->with('product')->get();
        return view('order.show', compact('order','orderProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->status=$request->status;
        $order->modified_by=Auth::user()->name;
        $update =$order->save();
        if ($update) {
            return redirect()->route('order.index')->with('success','Order Status updated successfully');
        } else {
            return redirect()->route('order.edit')->with('error','Order Status updated Failed');
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
