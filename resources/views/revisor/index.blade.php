<x-layout>
    <div class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- Carosello inizio --}}
                    <div class="container-fluid bg-body-secondary">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8">
                                <!-- Start Main Product Details -->
                                <div class="row bg-body-secondary">
                                    @if ($products_to_check->count())
                                    <h1 class="my-4">{{ __('indexRevisor.revisiona') }}</h1>
                                    @endif

                                    @foreach ($products_to_check as $product)
                                    <div class="card mb-3 p-0 revisor-card">
                                        <div class="row g-0">
                                            <div class="col-md-6">
                                                <img src="{{ Storage::url($product->images->first()->path) }}" class="img-fluid img-fit rounded-start w-100" alt="...">
                                            </div>
                                            <div class="col-md-6 align-items-center text-center d-flex">
                                                <div class="card-body d-flex flex-column">
                                                    <h3 class="">{{ $product->name }}</h3>
                                                    <p>{{ substr($product->description, 0, 100) . '...' }}</p>

                                                    <p>ID prodotto: {{ $product->id }}</p>
                                                    <p class=" ">Prezzo: {{ $product->price }} €</p>
                                                    <div class="d-flex gap-4 mt-auto justify-content-evenly">
                                                        <a class="btn btn-lg btn-info rounded-5" href="{{ route('revisor.prodottoDettaglio', ['id' => $product->id]) }}">
                                                            <i class=" fa-solid text-white fa-magnifying-glass"></i>
                                                        </a>
                                                        <form class="m-0" action="{{ route('revisor.accept_product', ['product' => $product]) }}" method="POST">@csrf @method('PATCH')
                                                            <button type="submit" class="btn rounded-5 btn-lg btn-success">
                                                                <i class="fa-regular fa-circle-check"></i>
                                                            </button>
                                                        </form>
                                                        <form class="m-0" action="{{ route('revisor.reject_product', ['product' => $product]) }}" method="POST">@csrf @method('PATCH')
                                                            <button type="submit" class="btn rounded-5 btn-lg btn-danger">
                                                                <i class="fa-regular fa-circle-xmark"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $products_to_check->links() }}

                                    @if ($products_accepted->count() > 0)
                                    <h1 class="my-4">{{ __('indexRevisor.accettato') }}</h1>
                                    @endif

                                    @foreach ($products_accepted as $product)
                                    <div class="card mb-3 p-0 revisor-card">
                                        <div class="row g-0 shadow-lg">
                                            <div class="col-md-6">
                                                <img src="{{ Storage::url($product->images->first()->path) }}" class="img-fluid img-fit rounded-start w-100" alt="...">
                                            </div>
                                            <div class="col-md-6 align-items-center text-center d-flex">
                                                <div class="card-body d-flex flex-column">
                                                    <h3>{{ $product->name }}</h3>
                                                    <p>{{ substr($product->description, 0, 100) . '...' }}</p>

                                                    <p>ID prodotto: {{ $product->id }}</p>
                                                    <p class=" ">Prezzo: {{ $product->price }} €</p>
                                                    <div class="d-flex gap-4 mt-auto justify-content-evenly">
                                                        <a class="btn btn-lg btn-info text-white rounded-5" href="{{ route('revisor.prodottoDettaglio', ['id' => $product->id]) }}">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </a>
                                                        <form class="m-0" action="{{ route('revisor.reject_product', ['product' => $product]) }}" method="POST">@csrf @method('PATCH')
                                                            <button type="submit" class="btn btn-lg btn-danger rounded-5">
                                                                <i class="fa-regular fa-circle-xmark"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $products_accepted->appends(['products_rejected_page' => $products_rejected->currentPage(), 'products_to_check_page' => $products_to_check->currentPage()])->links() }}

                                    @if ($products_rejected->count() > 0)
                                    <h1>{{ __('indexRevisor.rifiutato') }}</h1>
                                    @endif

                                    @foreach ($products_rejected as $product)
                                    <div class="card mb-3 p-0 revisor-card">
                                        <div class="row g-0 shadow-lg">
                                            <div class="col-md-6">
                                                <img src="{{ Storage::url($product->images->first()->path) }}" class="img-fluid img-fit rounded-start w-100" alt="...">
                                            </div>
                                            <div class="col-md-6 align-items-center text-center d-flex">
                                                <div class="card-body d-flex flex-column">
                                                    <h3>{{ $product->name }}</h3>
                                                    <p>{{ substr($product->description, 0, 100) . '...' }}</p>

                                                    <p>ID prodotto: {{ $product->id }}</p>
                                                    <p class=" ">Prezzo: {{ $product->price }} €</p>
                                                    <div class="d-flex gap-4 mt-auto justify-content-evenly ">
                                                        <a class=" text-white btn btn-lg btn-info rounded-5" href="{{ route('revisor.prodottoDettaglio', ['id' => $product->id]) }}">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </a>
                                                        <form class="m-0" action="{{ route('revisor.accept_product', ['product' => $product]) }}" method="POST">@csrf @method('PATCH')
                                                            <button type="submit" class=" rounded-5 btn btn-lg btn-success">
                                                                <i class="fa-regular fa-circle-check"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $products_rejected->appends(['products_accepted_page' => $products_accepted->currentPage(), 'products_to_check_page' => $products_to_check->currentPage()])->links() }}


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>