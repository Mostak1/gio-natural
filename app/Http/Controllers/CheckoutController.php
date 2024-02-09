<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    //Create Token
    public function checkout(Request $request)
    {
        // dd($request->all());
        // $orderData = $request->input('orderData');
        $merchantId = 4151705489973;
        $password   = 'StrPasAwcenter';

        $header = array(
            "merchantId:{$merchantId}",
            "password:{$password}"
        );

        $url = curl_init("https://api.paystation.com.bd/grant-token");
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $tokenData = curl_exec($url);
        curl_close($url);

        $token_res = json_decode($tokenData, true);


        if ($token_res['status_code'] == 200 && $token_res['status'] == 'success') {
            $response =  $this->createPayment($token_res, $request);
            // return response()->json(['token' => $token_res]);
            return redirect()->away($response['payment_url']); //Redirect to paystation payment page
            //For Inertia Js, Use this to avoid whole tab opening as modal
            // return inertia()->location($responseObject['payment_url']);
        } else {
            return redirect()->back();
        }
    }



    //Create Payment Url
    protected function createPayment($token_res, Request $request)
    {
        $token = $token_res['token'];

        $header = array(
            "token:{$token}"
        );

        $day = date('d'); // Day of the month (01 to 31)
        $month = date('m'); // Month (01 to 12)
        $year = date('Y'); // Year (e.g., 2024)
        $hour = date('H'); // Hour (00 to 23)
        $minute = date('i'); // Minute (00 to 59)
        $second = date('s'); // Second (00 to 59)

        $invoice_no = 'GIO' . $day . $month . $year . rand(111, 999) . $hour . $minute . $second;

        // dd($request->all());
        $payAmmount = $request->total;
        $name = $request->customer_name;
        $email = $request->customer_email;
        $address = $request->shipping_address;
        $phone = $request->phone;
        $invoice_number = $request->invoice_number;
        // dd($reference);
        $body = array(
            'invoice_number' => "{$invoice_number}",
            'currency' => "BDT",
            'payment_amount' => 1,
            'reference' => 'Gio-Natural',
            'cust_name' => $name,
            'cust_phone' => $phone,
            'cust_email' => $email,
            'cust_address' => $address,
            'callback_url' => route('store-transaction', $token),
            'checkout_items' => "orderItems"
        );

        $url = curl_init("https://api.paystation.com.bd/create-payment");
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($url, CURLOPT_POSTFIELDS, $body);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $responseData = curl_exec($url);
        curl_close($url);

        $response = json_decode($responseData, true);

        return $response;
    }

    //Verify transaction and store payment details
    public function storeTransaction(Request $request, $token)
    {

        if ($request->trx_id == null) {
            //redirect to cart page or dashboard page
            return redirect()->route('cart')->with('error', 'Order Tranjection Cancelled');
        }

        //get transaction information

        $header = array(
            "token:{$token}"
        );

        $body = array(
            'invoice_number' => $request->invoice_number,
            'trx_id' => $request->trx_id
        );

        $url = curl_init("https://api.paystation.com.bd/retrive-transaction");
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($url, CURLOPT_POSTFIELDS, $body);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $responseData = curl_exec($url);
        curl_close($url);

        $response = json_decode($responseData, true);

        if ($response['data']['trx_status'] == 'Failed' && $response['data']['trx_id'] == null) {
            //redirect to cart page or dashboard page
            return redirect()->route('cart')->with('error', 'Order Tranjection failed');
        }
        $order = Order::where('invoice_number', $request->invoice_number)->first();
        if (!$order) {
            // Handle the case where the order with the provided invoice number is not found
            return redirect()->route('cart')->with('error', 'Order not found');
        }

        // Update the trx_id column of the order
        $order->trx_id = $request->trx_id;
        $order->status = 'Received';

        // Save the changes to the database
        $order->save();
        // dd($request->all());
        $validatedData=[
            'name' => $request->customer_name,
            'email' => $request->customer_email,
            'phone' => $request->phone,
            'subject' => 'Order Confirmation Email',
            'comment' =>'Order Payment Received' ,
        ];
        // Mail::to(users: 'acrh.mostak@gmail.com')->send(new ContactFormMail($validatedData));
        // Mail::to(users: $request->customer_email)->send(new ContactFormMail($validatedData));
        //Store Transaction Information and redirect to success page
        echo 'store payment transaction';
        return redirect()->route('cart')->with('success', 'Order placed and paid successfully, Thank You');
    }
}
