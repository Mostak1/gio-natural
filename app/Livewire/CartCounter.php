<?php

namespace App\Livewire;

use Livewire\Component;

class CartCounter extends Component
{

    public $cartCount;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        // Your logic to retrieve cart count from session or database
        // For example, if using session storage:
        $cart = session('cart', []);
        $this->cartCount = count($cart);
    }
    public function render()
    {
        return view('livewire.cart-counter');
    }
}
