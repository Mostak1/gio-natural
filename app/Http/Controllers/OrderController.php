<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
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
            'phone' => 'required|string|unique:orders,phone',
            'message' => 'nullable|string',
            'subtotal' => 'required|numeric',
            // Add more validation rules as needed
        ]);

        // // Check if validation fails
        // if ($validator->fails()) {
        //     throw ValidationException::withMessages($validator->errors()->toArray());
        // }
        if ($validator->fails()) {
            // Return a JSON response with validation errors
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }

        // Create a new order
        // Start a database transaction
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

            // Save the order details
            // $order->orderDetails()->saveMany($orderDetails);

            // Commit the transaction
            DB::commit();

            // Return a success response
            return response()->json(['success' => 'Order placed successfully', 'order' => $order], 200);
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollback();

            // Return an error response
            return response()->json(['error' => 'Error placing order. ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        //
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
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
