<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $token; // To store the obtained token

    public function generateToken()
    {
        // Your existing code for generating token goes here

        // Replace the following with the actual logic
        $header = array(
            'merchantId:4151705489973',
            'password:StrPasAwcenter'
        );

        $url = curl_init("https://api.paystation.com.bd/grant-token");
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        // ... other CURL options ...

        $tokenData = curl_exec($url);
        curl_close($url);

        $tokenResponse = json_decode($tokenData, true);

        // Check if the token was obtained successfully
        
            $this->token = $tokenResponse['token'];
        
    }

    public function createPayment(Request $request)
    {
        // Call the generateToken method to obtain the token
        $this->generateToken();

        // Use the obtained token in the header for the createPayment request
        $header = array(
            'token:' . $this->token
        );

        $body = array(
            'invoice_number' => $request->input('invoice_number'),
            // ... other parameters ...
        );

        $url = curl_init("https://api.paystation.com.bd/create-payment");
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        // ... other CURL options ...
        curl_setopt($url, CURLOPT_POSTFIELDS, $body);

        $responseData = curl_exec($url);
        curl_close($url);

        return json_decode($responseData, true);
    }
    public function showGenerateTokenView()
    {
        return view('generate-token');
    }

    public function showCreatePaymentView()
    {
        return view('create-payment');
    }
}
