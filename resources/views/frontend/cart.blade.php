<x-frontend-layout>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <h2>Your Cart</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (empty($cart))
                <p>Your cart is empty.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            <tr>
                                <td width="200px">
                                    @if (file_exists(public_path('app/products/' . $item['photo'])))
                                        <img src="{{ asset('app/products/' . $item['photo']) }}" alt="{{ $item['name'] }}">
                                    @else
                                        <img src="{{ asset('images/default-product.png') }}" alt="Default Image">
                                    @endif
                                </td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>${{ $item['price'] }}</td>
                                <td>${{ $item['price'] * $item['quantity'] }}</td>
                                <td>
                                    <form action="{{ route('remove.from.cart', ['product_id' => $item['id']]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('checkout') }}"><button class="btn btn-success">Checkout</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>
</x-frontend-layout>