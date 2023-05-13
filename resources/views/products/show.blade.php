<x-layout>
    <div class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card card-body  shadow-lg">
                        <div class="card-body d-flex justify-content-between">

                            <div class="d-flex align-items-center w-100 justify-content-between">
                                <img src="{{ Storage::url($product->user->image) }}" class=" rounded-circle img-thumbnail border-dark  user-img-detail" alt="" />
                                <h1 class="fs-4 fw-bolder text-capitalize m-0">{{ $product->user->name }}</h1>
                                <!-- Bottone Contattami -->
                                <button class="btn contact-button btn-bg  " id="contactButton" onclick="document.getElementById('contactButton').style.display = 'none'; document.getElementById('emailContainer').style.display = 'block';">
                                    Contattami
                                </button>
                                <!-- Contenitore per l'email -->
                                <p class="btn contact-button btn-bg m-0" id="emailContainer" style="display: none; cursor: pointer;" onclick="document.getElementById('contactButton').style.display = 'block'; document.getElementById('emailContainer').style.display = 'none';">
                                    {{ $product->user->email }}
                                </p>
                            </div>

                        </div>
                        <!-- Sessione Image che sarà rimpiazzata da un carosello -->
                        <!-- Sessione Image che sarà rimpiazzata da un carosello -->
                        <div id="splide" class="splide detailsImg mt-2">
                            <div class="splide__track">
                                <ul class="splide__list mt-2">
                                    @foreach ($product->images as $image)
                                    <li class="splide__slide">
                                        <img src="{{ $image->getUrl() }}" class="img-fluid" alt="..." />
                                        {{-- {{ $image->getUrl() }} --}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="splide" class="splide detailsImgThumb">
                            <div class="splide__track">
                                <ul class="splide__list mt-2">
                                    @foreach ($product->images as $image)
                                    <li class="splide__slide">
                                        <img src="{{ $image->getUrl() }}" class="img-fluid" alt="..." />
                                        {{-- {{ $image->getUrl() }} --}}
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <!-- Fine Sessione IMacenterge -->
                        @if ($product->is_in_promotion)
                        <h2 class="card-text fw-bold mt-3"> <span class=" text-decoration-line-through text-danger ">{{ number_format($product->price, 2) }}</span>
                            €
                            -{{ number_format($product->is_in_promotion, 0) }}%</h2>
                        <h2 class="fw-bold  ">Now {{ $product->getPriceInPromotion() }}€ </h2>
                        @else
                        <h2 class="fs-2 fw-bolder">{{ $product->price }} EUR</h2>
                        @endif
                        <div class="d-flex align-items-center">
                            <a class="w-50" href="{{ route('categoryShow', $product->category) }}">
                                <img src="{{ $product->category->img }}" class="logo-deliver-comp" alt="" />
                                {{ $product->category->name }}
                            </a>
                            <a href="{{ route('regionShow', $product->region) }}" class="w-50  m-0 text-end">
                                {{ $product->region->name }} </a>
                        </div>
                        <p class="fs-5 border-top pt-4">
                            {{ $product->description }}
                        </p>
                        <h3 class="fs-5 fw-bolder">Consigli per la spedizione{{ __('showblade.consegna') }}</h3>
                        <div class="d-flex align-items-center mt-4">
                            <img class="logo-deliver-comp" src="https://prod-delivery-resources.wallapop.com/Bartolini.png" alt="" />
                            <p class="fs-5 m-0 ms-3">
                                {{ __('showblade.corriere') }}<span class="fw-bold">
                                    3.99 EUR</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                            <img class="logo-deliver-comp" src="https://prod-delivery-resources.wallapop.com/default_home.png" alt="" />
                            <p class="fs-5 m-0 ms-3">
                                {{ __('showblade.indirizzo') }}<span class="fw-bold"> da 4.99 EUR</span>
                            </p>
                        </div>

                        <div class="border rounded-5 p-4">
                            <div class="mb-4 d-flex align-items-center">
                                <img src="https://it.wallapop.com/images/icons/warranty.svg" alt="" />
                                <p class="fw-bold fs-5 m-0 ms-3">
                                    {{ __('showblade.protezione') }}
                                </p>
                            </div>
                            <div class="mb-4 d-flex align-items-center">
                                <img class="card-images-deliver" src="https://it.wallapop.com/images/icons/warranty-check.svg" alt="" />
                                <p class="fs-5 m-0 ms-3">
                                    {{ __('showblade.garanzia') }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="card-images-deliver" src="https://it.wallapop.com/images/icons/warranty-check.svg" alt="" />
                                <p class="fs-5 m-0 ms-3">
                                    {{ __('showblade.conferma') }}
                                </p>
                            </div>
                        </div>
                        <p class="fs-5 border-top py-4 border-bottom">
                            {{ __('showblade.pubblicato') }} {{ $product->created_at->format('d/m/Y') }}
                        </p>
                        <h3>{{ __('showblade.visualizza') }}</h3>
                        <div id="splide" class="splide splide-thumbnails mt-5">
                            <div class="splide__track">
                                <ul class="splide__list mt-4">
                                    @foreach ($productsCategory as $product)
                                    <li class="splide__slide">
                                        {{-- <a href="{{ route('product.show', compact('product')) }}"
                                        class="card card-prodotti rounded-5">
                                        <img src="{{ $product->images->first()->getUrl() }}" class="card-img-top img-fluid " alt="..." />
                                        <div class="d-flex justify-content-between mt-3 align-content-center">
                                            <img src="{{ $product->category->img }}" alt="" width="24" height="24" />
                                            <p class="card-text fw-bold">
                                                {{ number_format($product->price, 2) }} €
                                            </p>
                                        </div>
                                        <div class="mt-3">
                                            <p>
                                                {{ $product->name }}
                                            </p>
                                        </div>
                                        </a> --}}
                                        <x-card :product="$product" />
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-layout>