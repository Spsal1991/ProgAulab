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
                                    <h1 class="my-4"> {{ __('edit.carica') }}
                                    </h1>
                                    @foreach ($productsUser as $product)
                                    <div class="card mb-3 p-0 revisor-card">
                                        <div class="row g-0 shadow-lg">
                                            <div class="col-md-6">
                                                <img src="{{ Storage::url($product->images->first()->path) }}" class="img-fluid img-fit rounded-start w-100" alt="...">
                                            </div>
                                            <div class="col-md-6 align-items-center text-center d-flex">
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="h3">{{ $product->name }}</h5>
                                                    <p>{{ substr($product->description, 0, 100) . '...' }}</p>
                                                    <p>ID prodotto: {{ $product->id }}</p>
                                                    <p class="h4 ">{{ $product->price }} €</p>
                                                    <div class="d-flex gap-4 mt-auto justify-content-center">
                                                        <a class="btn btn-lg rounded-5 btn-info" href="{{ route('user.prodottoDettaglio', ['id' => $product->id]) }}">
                                                            <i class="fa-solid fa-pen-to-square text-white"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $productsUser->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>