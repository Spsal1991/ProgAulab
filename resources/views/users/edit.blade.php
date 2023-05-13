<x-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg form-product">

                    <h3 class="text-center">{{ __('edit.Modifica') }}</h3>

                    <div class="card-body">
                        <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 text-center">
                                @if (Auth::check() && Auth::user()->image)
                                <img class="img-profile img-fluid rounded-circle mb-3" src="{{ Storage::url(Auth::user()->image) }}" alt="">
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="name" class="form-label fw-light text-secondary">{{ __('edit.name') }}</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="region_id" class="form-label fw-light text-secondary">{{ __('edit.regione') }}</label>
                                <select name="region_id" id="region_id" class="form-control">
                                    <option value="">{{ __('edit.Reg') }}</option>
                                    @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" {{ old('region_id', $user->region_id) == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('region_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="image" class="form-label fw-light text-secondary">{{ __('edit.profilo') }}</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="form-label fw-light text-secondary">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary px-5 rounded-5">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>