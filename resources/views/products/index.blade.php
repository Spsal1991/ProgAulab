<x-layout>
    <x-header title="{{ __('index.allProducts') }}" />

    <div class="container my-5">
        <div class="row d-flex flex-wrap">
            @forelse($products as $product)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <x-card :product="$product" />
                </div>
            @empty
                <div class="col-12">
                    <p>No products found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4 prova">
            {{ $products->fragment('product-list')->links() }}
        </div>
    </div>

    <!-- {{-- <x-sidebar/> --}} -->
</x-layout>
