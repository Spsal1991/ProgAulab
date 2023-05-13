<x-layout>
    <div class="bg-header header-bg-img">
        <div class="container position-relative">
            <x-header title="BoomBuy" />
            <div class="w-100 my-5 d-flex justify-content-center  " id="ricerca">
                <form action="{{ route('products.search') }}" class="w-75" method="GET">
                    <input name="searched" class="w-100 rounded-5 p-3 border-0" type="search" placeholder="Cerca...">
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row py-3 justify-content-around ">
            <div class="col-10 col-md-8 col-lg-12">
                {{-- Splide-Categories-Carousel --}}
                <div id="splide" class="splide splide-slide mt-5">
                    <div class="splide__track text-center">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <a href="http://127.0.0.1:8000/products/index" class="d-block">
                                    <img src="/Media-Css/all.png" alt="" class="img-logo">
                                    <p class="mt-3 mb-0">{{ __('welcome.tutteCategorie') }}</p>
                                </a>
                            </li>
                            @foreach ($categories as $category)
                            <li class="splide__slide">
                                <a href="{{ route('categoryShow', $category) }}" class="d-block">
                                    <img class="img-logo" src="{{ $category->img }}" alt="">
                                    <p class="mt-3 mb-0">{{ __('category.' . strtolower($category->name)) }}</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row py-3   justify-content-around ">

            <h3 class="mb-1 mt-5">{{ __('welcome.ordData') }}</h3>
            @foreach ($products as $product)
            <div class="col-10 col-md-8 col-lg-3 my-5 ">
                <x-card :product="$product" />
            </div>
            @endforeach
            <h3 class="mb-1 mt-5 text-end ">{{ __('welcome.ordPrezzo') }} </h3>
            @foreach ($productsPrice as $productPrice)
            <div class="col-10 col-md-8 col-lg-3 my-5 ">
                <x-card :product="$productPrice" />
            </div>
            @endforeach
            @auth
            @if ($products_promotion->isNotEmpty())
            <h3 class="mb-1 mt-5 text-start">Prodotti in Promozione</h3>

            @foreach ($products_promotion as $productPromoted)
            <div class="col-10 col-md-8 col-lg-3 my-5">
                <x-card :product="$productPromoted" />
            </div>
            @endforeach
            @endif
            @endauth
            @auth
            @if ($productsRegion->isNotEmpty())
            <h3 class="mb-1 mt-5 text-end">Nella tua Regione: {{ Auth::user()->region->name }}</h3>

            @foreach ($productsRegion as $productRegion)
            <div class="col-10 col-md-8 col-lg-3 my-5">
                <x-card :product="$productRegion" />
            </div>
            @endforeach
            @endif
            @endauth
        </div>
    </div>
    <div class="bg-header banner-work-bg">
        <div class="container position-relative text-center py-5">
            <h3 class="display-2 fw-bold">
                {{ Auth::user() && Auth::user()->is_revisor ? __('welcome.benvenuto') : __('welcome.lavoraConNoi') }}
            </h3>
            @if (!Auth::user() || (Auth::user() && !Auth::user()->is_revisor))
            {{-- <p class="h5">{{ __('welcome.lavoraConNoi') }}</p> --}}
            <a href="{{ route('become.revisor') }}" class="btn btn-lg btn-outline-light  banner-button mt-4">{{ __('welcome.revisore') }}
            </a>
            @endif
        </div>
    </div>
</x-layout>