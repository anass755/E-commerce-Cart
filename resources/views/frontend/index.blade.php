<x-frontend-layout>
    <section style="background-color: #eee;">
    @if(session('success'))
            <div class="alert alert-success" style="text-align:center">{{ session('success') }}</div>
         @endif
        <div class="container py-5">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                        <div class="card mt-4">
                            <div class="d-flex justify-content-between p-3">
                                <p class="lead mb-0">{{ $product->category->name ?? 'Category' }}</p>
                                <div class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                                    style="width: 35px; height: 35px;">
                                    <p class="text-white mb-0 small">x4</p>
                                </div>
                            </div>
                            <img src="{{ ($product->photo == 'defaultproduct.png') ? asset('images/default_images/defaultproduct.png') : asset('app/products/' . $product->photo) }}"
                                class="card-img-top" alt="{{ $product->name }}" />
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="small"><a href="#!" class="text-muted">{{ $product->subcategory->name ?? 'Subcategory' }}</a></p>
                                    <p class="small text-danger"><s>$1099</s></p>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">{{ $product->name }}</h5>
                                    <h5 class="text-dark mb-0">${{ $product->rate }}</h5>
                                </div>

                                <!-- Add to Cart Form -->
                                <form action="{{ route('addtocart', ['product_id' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="d-block mx-auto cart-btn btn btn-success">Add to Cart</button>
                                </form>

                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-muted mb-0">Available: <span class="fw-bold">6</span></p>
                                    <div class="ms-auto text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-frontend-layout>