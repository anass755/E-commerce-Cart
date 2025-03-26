<x-frontend-layout>
    <section style="background-color: #eee;">
        <div class="container py-5">
        <h1>Your Orders</h1>

@if ($orders->isEmpty())
    <p>No orders found.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ $order->total_amount }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>
                                    <a href="{{ route('orders.details', $order->id) }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        <div>
    <section>
</x-frontend-layout>        