<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class AddToCartComponent extends Component
{
    public $product;

    public function mount($productId)
    {
        // Fetch product details based on the productId (assuming you have a method for this)
        $this->product = Product::find($productId);
    }

    public function addToCart()
    {
        // Retrieve cart items from session or initialize an empty array
        $cart = session('cart', []);

        // Add the current product to the cart
        $cart[] = $this->product;

        // Store the updated cart back into session
        session(['cart' => $cart]);

        // Emit event to notify other components (e.g., CartCounter) that the cart has been updated
        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('livewire.add-to-cart-component');
    }
}

