<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = Cart::with('book')->where('user_id', Auth::id())->get();

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->book->price * $item->quantity;
        }

        return view('cart.index', compact('cartItems', 'total'));
    }


    public function add(Book $book)
    {
        $existing = Cart::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($existing) {
            $existing->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Book added to cart.');
    }

    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::with('book')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->book->price * $item->quantity;
        }

        if ($user->balance < $total) {
            return redirect()->route('cart.index')->with('error', 'Insufficient balance.');
        }

        DB::beginTransaction();
        try {
            $invoice = Invoice::create([
                'user_id' => $user->id,
                'total_price' => $total,
            ]);

            foreach ($cartItems as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'book_id' => $item->book_id,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->book->price * $item->quantity,
                ]);
            }

            $user->update([
                'balance' => $user->balance - $total,
            ]);

            Cart::where('user_id', $user->id)->delete();

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Checkout failed.');
        }
    }
}
