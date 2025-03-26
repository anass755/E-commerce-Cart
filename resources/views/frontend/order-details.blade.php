<x-frontend-layout>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <h1>Order Details - #{{ $order->id }}</h1>
            <div class="order-info">
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
            </div>

            <h2>Shipping Address</h2>
            <div class="address-info">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th><i class="fas fa-map-marker-alt"></i> Name</th>
                                <td>{{ $order->address->name }}</td>
                            </tr>
                            <tr>
                                <th> Place</th>
                                <td>{{ $order->address->place }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-map-marker-alt"></i> Address </th>
                                <td>{{ $order->address->address_line1 }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-map-marker-alt"></i> Address Line 2</th>
                                <td>{{ $order->address->address_line2 ?? 'N/A' }}</td>
                            </tr>
                            
                            <tr>
                                <th><i class="fas fa-city"></i> City</th>
                                <td>{{ $order->address->city }}</td>
                            </tr>
                            <tr>
                                <th> District</th>
                                <td>{{ $order->address->district }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $order->address->state }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-mail-bulk"></i> Pincode</th>
                                <td>{{ $order->address->pincode }}</td>
                            </tr>
                            <tr>
                                <th>Mobile No</th>
                                <td>{{ $order->address->mobile_no }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-phone-alt"></i> Alternative Mobile No</th>
                                <td>{{ $order->address->alternative_mobile ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h2>Items:</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->quantity * $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('orders.view') }}" class="btn btn-secondary">
                Back to Orders
            </a>
        </div>
    </section>
</x-frontend-layout>