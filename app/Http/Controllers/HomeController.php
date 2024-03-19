<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\TestEmail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::with('category')
            ->orderBy('id', 'DESC')
            ->take(3)
            ->get();
        return view('users.home', compact('products'));
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
    public function nDetails()
    {
        return view('users.newsDetails');
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
        $categories = Category::get();
        $products = Product::with('category')->orderBy('id', 'DESC')->paginate(6);

        return view('users.shop', compact('categories','products'));
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
            'comment' => 'required|string',
        ]);
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $subject = $request->subject;
        $message = $request->comment;
        // Send email to the specified email address
        //    $mail= Mail::to(users: 'acrh.mostak@gmail.com')->send(new ContactFormMail($name, $email, $phone, $subject, $message));
        //    $mail= Mail::to(users: 'gionaturals.rakib@gmail.com')->send(new ContactFormMail($validatedData));
        $mail = Mail::to(users: 'acrh.mostak@gmail.com')->send(new ContactFormMail($validatedData));

        if ($mail) {
            return redirect()->back()->with('success', 'Email sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }
    }
    public function order()
    {
        return view('users.order');
    }
    public function orderDetails2($id)
    {
        $item = Order::with('orderDetails.product')->find($id);
        return response()->json($item);
    }
    public function orderDetails($id)
    {
        $item = Order::with('orderDetails.product')->find($id);
        $details = OrderDetail::with('product')->where('order_id',$id)->get();
        return view('users.order-details',compact('item','details'));
    }
    public function orderjson(Request $request)
    {
        $orderData = Order::with('orderDetails.product')->where('phone', $request->phone)->get();
        return response()->json($orderData);
    }
}
