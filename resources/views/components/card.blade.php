@if ($product->is_in_promotion)
    <a href="{{ route('product.show', compact('product')) }}" class="card card-prodotti rounded-5">
        <img src="{{ $product->images->first()->getUrl() }}" class="card-img-border img-fluid " alt="..." />
        <div class="d-flex justify-content-between mt-3 align-content-center">
            <img src="{{ $product->category->img }}" alt="" width="24" height="24" />
            <p class="card-text fw-bold"> <span
                    class=" text-decoration-line-through text-danger ">{{ number_format($product->price, 2) }}</span>
                €
                -{{ number_format($product->is_in_promotion, 0) }}%</p>
        </div>
        <div class="d-flex mt-3 justify-content-between ">
            <p>
                {{ $product->name }}
            </p>
            <p class="fw-bold card-text ">Now {{ $product->getPriceInPromotion() }}€ </p>
        </div>
    </a>
@else
    <a href="{{ route('product.show', compact('product')) }}" class="card card-prodotti rounded-5">
        <img src="{{ $product->images->first()->getUrl() }}" class="card-img-border img-fluid " alt="..." />
        <div class="d-flex justify-content-between mt-3 align-content-center">
            <img src="{{ $product->category->img }}" alt="" width="24" height="24" />
            <p class="card-text fw-bold">{{ number_format($product->price, 2) }} €</p>
        </div>
        <div class="mt-3">
            <p>
                {{ $product->name }}
            </p>
        </div>
    </a>
@endif
