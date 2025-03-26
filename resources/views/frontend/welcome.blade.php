<x-frontend-layout>
<div class="hero-section">
<img src="images/image.avif" alt="" >
        <div class="text-center" style="position:absolute">
            <h1>Welcome to Your Store</h1>
            <p>Discover the best products at amazing prices.</p>
            <a href="{{ route('welcome.index',['sub_category'=>$category->id]) }}" class="btn btn-primary">Shop Now</a>
        </div>
    </div>
</x-frontend-layout>