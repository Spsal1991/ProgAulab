<x-layout-form>
    <div class="row justify-content-center align-items-center vh-100 register-bg">
        <div class="col-10 col-md-8 col-lg-3">
            <div class="card bg-transparent rounded-5 overflow-hidden">
                <img src="/Media-Css/cat.jpg" class="card-img-top" alt="">
                <form method="POST" action="{{ route('register') }}" class="card-body m-0 form-register-bg">
                    @csrf
                    <div class="mb-0">
                        <h3 class=" mt-2 text-center text-white">{{__('register.unix')}}</h3>
                        <label class="form-label"></label>
                        <input type="text" class="form-control rounded-3" name="name" placeholder="{{__('register.nan')}}">
                    </div>
                    <div class="mb-0 ">
                        <label class="form-label"></label>
                        <input type="email" class="form-control rounded-3" name="email" placeholder="{{__('register.mail')}}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label"></label>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-3" name="password" placeholder="{{__('register.pas')}}">
                            <button class="btn toggle-password" type="button">
                                <i class="far fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"></label>
                        <div class="input-group">
                            <input type="password" class="form-control rounded-3" name="password_confirmation" placeholder="{{__('register.pas2')}}">
                            <button class="btn toggle-password-confirm" type="button">
                                <i class="far fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class=" button-3 p-2 w-100 rounded-5">{{__('register.rec')}}</button>
                    <a href="{{ route("login") }}" class="text-white mt-2 d-block text-center p-2 w-100 rounded-5">
                        Login
                    </a>
                    <a href="{{ route("homepage") }}" class=" text-white d-block text-center p2 w-100 rounded-5 link-homepage-register">
                        Torna all'homepage
                    </a>
                </form>
            </div>
        </div>
    </div>
</x-layout-form>