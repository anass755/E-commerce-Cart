<x-frontend-layout>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <h2>Checkout</h2>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                    <h4>Shipping Address</h4>
                        <!-- Address Fields -->
                        <div class="form-group">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address_line1">Address Line 1</label>
                            <input type="text" name="address_line1" id="address_line1" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address_line2">Address Line 2</label>
                            <input type="text" name="address_line2" id="address_line2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="place">Place</label>
                            <input type="text" name="place" id="place" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" name="district" id="district" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode</label>
                            <input type="text" name="pincode" id="pincode" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile_no">Mobile No</label>
                            <input type="text" name="mobile_no" id="mobile_no" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="alternative_mobile">Alternative Mobile No</label>
                            <input type="text" name="alternative_mobile" id="alternative_mobile" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>Order Summary</h4>
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
                                @foreach ($cart as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>${{ $item['price'] }}</td>
                                        <td>${{ $item['price'] * $item['quantity'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h5>Total: ${{ $total }}</h5>
                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-frontend-layout>
