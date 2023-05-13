<nav class="navbar footer-navbar-color navbar-expand-lg  sticky-top">
    <div class="container-fluid footer-navbar-color  ">
        <a class="navbar-brand" href="{{ route('homepage') }}"><img src="/Media-Css/logo2.png" class="img-fluid logo-nav" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse bg-dropdown" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('homepage') }}">Home</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('products.index') }}">{{ __('ui.navProduct') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="categoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('ui.navCategory') }}
                    </a>
                    <ul class="dropdown-menu footer-navbar-color " aria-labelledby="categoriesDropdown">
                        @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item" href="{{ route('categoryShow', compact('category')) }}">
                                {{ __('category.' . strtolower($category->name)) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>




            </ul>
            <div class="container d-none d-sm-block ">
                <div class="row">
                    <div class="col-12  " id="sparisce">
                        <form action="{{ route('products.search') }}" class="w-100 " method="GET">
                            <input name="searched" class="w-100 border-0 rounded-5 p-2 mt-3" type="search" placeholder="{{ __('ui.navSearch') }}">
                        </form>
                    </div>
                </div>
            </div>

            {{-- INIZIO SEZIONE REGIONE --}}

            <ul class="navbar-nav   ">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="categoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">Regioni
                    </a>
                    <ul class="dropdown-menu footer-navbar-color" aria-labelledby="categoriesDropdown">
                        @foreach ($regions as $region)
                        <li>
                            <a class="dropdown-item small " href="{{ route('regionShow', compact('region')) }}">
                                {{ $region->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown flex-form mr-4 me-auto ms-md-auto ">
                    <a class="nav-link dropdown-toggle  text-capitalize h-50 align-self-center " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">


                        <i class="fa-solid fa-user"></i>
                        @guest
                        {{ __('ui.navUser') }}
                        @else
                        {{ Auth::user()->name }}
                        @endguest
                    </a>
                    <ul class="dropdown-menu footer-navbar-color">
                        @guest
                        {{-- Link Login --}}
                        <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('ui.navLogin') }}</a></li>
                        {{-- Link Register --}}
                        <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('ui.navRegister') }}</a>
                        </li>
                        @else
                        {{-- link Logout --}}
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class=" m-0 p-0">@csrf
                                <button type="submit" class="dropdown-item text-white fw-bold ">{{ __('ui.navLogout') }}</button>
                            </form>
                        </li>
                        @if (Auth::user()->is_revisor)
                        <li>
                            <a class="dropdown-item" href="{{ route('revisor.index') }}">{{ __('ui.navRevisor') }}</a>
                        </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('user.indexProdotti') }}">
                                {{ __('ui.navProdotti') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('users.edit') }}"> {{ __('ui.navModifica') }}</a>
                        </li>

                        @endguest
                    </ul>
                <li class="nav-item dropdown">
                    @php
                    $locale = app()->getLocale();
                    $flag = '';
                    switch ($locale) {
                    case 'it':
                    $flag = 'flags/it.jpg';
                    break;
                    case 'en':
                    $flag = 'flags/gb.png';
                    break;
                    case 'es':
                    $flag = 'flags/es.jpg';
                    break;
                    }
                    @endphp
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset($flag) }}" alt="{{ $locale }}" width="20" height="13">
                    </a>
                    <ul class="dropdown-menu footer-navbar-color">
                        <li class="dropdown-item">
                            <x-_locale lang="it" nation="it" />
                        </li>
                        <li class="dropdown-item">
                            <x-_locale lang="en" nation="gb" />
                        </li>
                        <li class="dropdown-item">
                            <x-_locale lang="es" nation="es" />
                        </li>
                    </ul>
                </li>
                @guest

                <li>
                    <button class="btn-custom my-3 my-md-0 "> <a class=" text-center text-white " href="{{ route('product.create') }}"> <i class="fa-solid fa-plus mx-auto"></i>
                            {{ __('ui.navButton') }}</a>
                    </button>

                </li>
                @else
                <li>
                    <button class="btn-custom my-3 my-md-0 ">
                        <a class=" text-center  text-white " href="{{ route('login') }}"> <i class="fa-solid fa-plus mx-auto"></i> {{ __('ui.navButton') }}</a>
                    </button>

                </li>
                @endguest



                </li>
            </ul>
        </div>
    </div>
</nav>