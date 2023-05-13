<div>
    <div class="card shadow-lg form-product">
        <div class="card-body">
            <h1 class="text-center">
                {{ __('product-form-edit.titolo') }}
            </h1>
            <form wire:submit.prevent="updateArticle()" class="text-dark d-flex flex-column justify-content-center">
                <div class="row">
                    {{-- Sezione Nome Prodotto --}}
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label fw-light text-secondary">
                                {{ __('productform.name') }}
                            </label>
                            <input type="text" class="form-control text-secondary"
                                placeholder="{{ __('productform.name') }}" wire:model.debounce.lazy="name"
                                maxlength="15">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Selezione categorie nel form --}}
                    <div class="col-6">
                        <label class="form-label fw-light text-secondary">
                            {{ __('productform.category') }}
                        </label>
                        <select id="" class="form-control text-secondary" wire:model="category_id">
                            <option value="">{{ __('productform.scegli') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Selezione regioni nel form --}}
                    <div class="col-6">
                        <label class="form-label fw-light text-secondary">
                            {{ __('product-form-edit.regione') }}
                        </label>
                        <select id="" class="form-control text-secondary" wire:model="region_id">
                            <option value="">{{ __('product-form-edit.rec') }}</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Sezione Prezzo nel form --}}
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label fw-light text-secondary">
                                {{ __('productform.price') }}
                            </label>
                            <input value="{{ $userProduct->price }}" type="number" class="form-control text-secondary"
                                placeholder="{{ __('productform.price') }}" wire:model.debounce.lazy="price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- Sezione promozione nel form --}}
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label fw-light text-secondary">
                                {{ __('product-form-edit.sconto') }}
                            </label>
                            <input type="number" class="form-control text-secondary"
                                @if (!$tempo) disabled @endif
                                placeholder="{{ $userProduct->is_in_promotion }}"
                                wire:model.debounce.lazy="is_in_promotion">
                            @error('is_in_promotion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (!$tempo)
                                <p class="small text-danger">{{ __('product-form-edit.scontare') }}</p>
                            @else
                                <p class="small text-success">{{ __('product-form-edit.puoi') }}</p>
                            @endif
                        </div>
                    </div>
                    {{-- Sezione Descrizione --}}
                    <div class="mb-3">
                        <label class="form-label fw-light text-secondary">
                            {{ __('productform.description') }}
                        </label>
                        <textarea wire:model.debounce.lazy="description" placeholder="{{ __('productform.description') }}" cols="30"
                            rows="5" class="form-control text-secondary maxlength="800""></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- sezione img --}}
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">{{ __('product-form-edit.photo') }}</p>
                            <div class="row rounded">
                                @foreach ($userProduct->images as $image)
                                    <div class="img-preview w-50 mx-auto shadow rounded position-relative"
                                        style="background-image:url({{ Storage::url($image->path) }})">
                                        <button type="button"
                                            class="btn position-absolute bottom-0 delete-btn-detail start-0  end-0 top-0 bg-opacity-50 bg-dark text-white"
                                            wire:click="cancelImage({{ $image }})">
                                            <i class="fa-regular fa-trash-can fs-4"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 w-100 d-flex justify-content-center">
                    <input wire:model.debounce.lazy="temporary_images" type="file"
                        class="price-custom text-white p-2 @error('temporary_images.*') is-invalid @enderror" multiple
                        placeholder="Img">
                </div>
                @if ($errors->has('temporary_images'))
                    <div class="alert alert-danger">
                        {{ $errors->first('temporary_images') }}
                    </div>
                @endif
                @if (!empty($images))
                    <div class="row">
                        <div class="col-12">
                            <p class="text-white text-center">{{ __('create_article.photoPreview') }}</p>
                            <div class="row">
                                @foreach ($images as $key => $image)
                                    <div class="img-preview w-50 mx-auto shadow rounded position-relative"
                                        style="background-image:url({{ $image->temporaryUrl() }})">
                                        <button type="button"
                                            class="btn position-absolute bottom-0 delete-btn-detail start-0  end-0 top-0 bg-opacity-50 bg-dark text-white"
                                            wire:click="removeImage({{ $key }})">
                                            <i class="fa-regular fa-trash-can fs-4"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                {{-- end img --}}
                <button type="submit" class="btn btn-lg btn-success mt-4 w-75 align-self-center">
                    {{ __('productform.button') }}
                </button>
            </form>
        </div>
    </div>
</div>
