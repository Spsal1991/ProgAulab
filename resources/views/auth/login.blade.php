<x-layout-form>
    <div class="row justify-content-center align-items-center vh-100  register-bg ">
        <div class="col-10 col-md-8 col-lg-3">
            <div class="card bg-transparent rounded-5 overflow-hidden">
                <img src="/Media-Css/cat2.jpg" class="card-img-top" alt="">
                <form method="POST" action="{{ route('login') }}" class="card-body m-0 form-register-bg">
                    @csrf

                    <div class="mb-0 ">
                        <label class="form-label"></label>
                        <input type="email" class="form-control rounded-3" name="email"
                            placeholder="{{ __('login.e-mail') }}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label"></label>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-3" name="password"
                                placeholder="{{ __('login.password') }}">
                            <button class="btn toggle-password" type="button">
                                <i class="far fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class=" button-3 mt-2 p-2 w-100 rounded-5">{{ __('login.acced') }}</button>
                    <a href="{{ route('register') }}" class="mt-2 text-white d-block text-center p-2 w-100 rounded-5">
                        {{ __('login.register') }}
                    </a>
                    <a href="{{ route('homepage') }}"
                        class=" text-white d-block text-center p2 w-100 rounded-5 link-homepage-register">
                        {{ __('register.homepage') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>
