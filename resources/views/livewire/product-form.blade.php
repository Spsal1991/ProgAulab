<div class="card form-product">
    {{-- <img src="/Media-Css/caricaprodotto.png" class="card-img-top contain" height="300" alt="card img"> --}}
    <div class="card-body">
        <h1 class="text-center">{{ __('create.create') }}</h1>
        {{-- Richiamo funzione Store di Product-form--Liveware --}}
        <form wire:submit.prevent="store" class="text-dark d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mt-2 mb-3">
                        <label class="form-label fw-light text-secondary">{{ __('productform.name') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('productform.name') }}"
                            wire:model.debounce.lazy="name" maxlength="15">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Seleziona Categorie --}}
                <div class="col-12 col-md-6">
                    <div class="mt-2 mb-3">
                        <label
                            class="form-label fw-light text-secondary text-capitalize">{{ __('productform.category') }}</label>
                        <select name="category_id" id="" class="form-control text-secondary"
                            wire:model="category">
                            <option value="">{{ __('productform.scegli') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Selezione regioni nel form --}}
                <div class="col-12 col-md-6">
                    <div class="mt-2 mb-3">
                        <label class="form-label fw-light text-secondary">{{ __('create.Scegli la zona') }}</label>
                        <select name="region_id" id="" class="form-control  text-secondary"
                            wire:model="region">
                            <option value="">{{ __('create.Scegli la zona (solo Italia)') }}</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- Selezione Prezzo nel form --}}
                <div class="col-12 col-md-6">
                    <div class="mt-2 mb-3">
                        <label class="form-label fw-light text-secondary">{{ __('productform.price') }}</label>
                        <input type="number" class="form-control" placeholder="{{ __('productform.price') }}"
                            wire:model.debounce.lazy="price">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label class="form-label fw-light text-secondary">{{ __('productform.description') }}</label>
                <textarea wire:model.debounce.lazy="description" placeholder="{{ __('productform.description') }}" cols="30"
                    rows="5" class="form-control" maxlength="800"></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            {{-- sezione img --}}
            <div class="mb-3">

                <input wire:model.debounce.lazy="temporary_images" type="file" name="images" multiple
                    class='form-control text-secondary @error(' temporary_images.*') is-invalid @enderror'
                    placeholder="Img" />
                @error('temporary_images')
                    <span class="text-danger">{{ implode(', ', $temporary_images) }}</span>
                @enderror
            </div>
            @if (!empty($images))
                <div class="d-flex flex-wrap">

                    @foreach ($images as $key => $image)
                        <div class="img-preview w-50 mx-auto shadow rounded position-relative"
                            style="background-image:url({{ $image->temporaryUrl() }})">
                            <button type="button"
                                class="btn position-absolute bottom-0 delete-btn-detail start-0  end-0 top-0 bg-opacity-50 bg-dark text-white"
                                wire:click="removeImage({{ $key }})"><i
                                    class="fa-regular fa-trash-can fs-4"></i></button>
                        </div>
                    @endforeach

                </div>

            @endif

            {{-- end img --}}
            <button type="submit"
                class="btn btn-lg btn-success mt-4 align-self-center rounded-5 w-75">{{ __('productform.button') }}</button>
        </form>
    </div>
</div>
