<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\TestEmail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home()
    {
        return view('users.home');
    }
    public function about()
    {
        return view('users.about');
    }
    public function contact()
    {
        return view('users.contact');
    }
    public function news()
    {
        return view('users.news');
    }
    public function cart(Request $request)
    {
        $cartItemIds = $request->session()->get('cart', []);
        // dd($cartItemIds );
        // Fetch the actual product details from the database based on the IDs
        $cartItems = Product::whereIn('id', $cartItemIds)->get();
        return view('users.cart', compact('cartItems'));
    }
    public function shop()
    {
        $products = Product::with('category')
            ->orderBy('id', 'DESC')
            ->paginate(6);
        return view('users.shop', compact('products'));
    }
    public function submitContactForm1(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Send email
        // Mail::to($validatedData['email'])->send(new ContactFormMail($validatedData));
        // Send email to the specified email address
        Mail::to('mdmostaka@gmail.com')->send(new ContactFormMail($validatedData));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Email sent successfully!');
    }
    public function submitContactForm(Request $request)
    {
        // try {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message = $request->message;
        // Send email to the specified email address
    //    $mail= Mail::to(users: 'acrh.mostak@gmail.com')->send(new ContactFormMail($name, $email, $phone, $subject, $message));
       $mail= Mail::to(users: 'acrh.mostak@gmail.com')->send(new ContactFormMail($validatedData));

        if ($mail) {
            return redirect()->back()->with('success', 'Email sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }
    }
}
