<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Category;

class FrontEndController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('sub_category', $request->sub_category)->get();
        return view('frontend.index', compact('products'));
    //    hlllllloo
    }

    public function addToCart(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += 1;
        } else {
            $cart[$product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->rate, 
                'photo' => $product->photo,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('frontend.cart', compact('cart'));
    }

    public function removeCart(Request $request, $product_id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart!');
    }
    public function mainview(){
      $category=Category::where('parent_category' ,1 )->first();
       
        return view('frontend.welcome',compact('category'));
    }

    public function checkout()
{
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
    }

    $total = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));

    return view('frontend.checkout', compact('cart', 'total'));
}
public function processCheckout(Request $request)
{
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
    }

 
    $total = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));


    $order = Order::create([
        'user_id' => auth()->id(),
        'guest_email' => $request->guest_email ?? null,
        'total_amount' => $total,
        'status' => 'pending',
    ]);
   
    
    $address = Address::create([
        'user_id' => auth()->id(),
        'name'=>$request->name,
        'address_line1' => $request->address_line1,
        'address_line2' => $request->address_line2,
        'place' => $request->place,
        'city' => $request->city,
        'district' => $request->district,
        'state' => $request->state,
        'pincode' => $request->pincode,
        'mobile_no' => $request->mobile_no,
        'alternative_mobile' => $request->alternative_mobile,
    ]);

    
    $order->address()->associate($address);
    $order->save();

   
    foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    
    session()->forget('cart');

    return redirect()->route('thankyou')->with('success', 'Order placed successfully!');
}
public function viewOrders()
{
    
    $orders = Order::where('user_id', auth()->id())
                   ->with('items.product')
                   ->orderBy('created_at', 'desc') 
                   ->get();

    return view('frontend.order', compact('orders'));
}
public function orderDetails($id)
{
   
    $order = Order::where('user_id', auth()->id())
                  ->with('items.product') 
                  ->findOrFail($id);

    return view('frontend.order-details', compact('order'));
}
}