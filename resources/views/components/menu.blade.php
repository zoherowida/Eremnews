<div class="site-navbar py-2">

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
                <div class="site-logo">
                    <a href="index.html" class="js-logo-clone">Medical</a>
                </div>
            </div>
            <div class="main-nav d-none d-lg-block">
                <nav class="site-navigation text-right text-md-center" role="navigation">
                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                        <li class="{{ (request()->is('/') || request()->is('home')) ? 'active' : '' }}"><a
                                href="{{route('web.index')}}">Home</a></li>
                        <li class="{{ (request()->is('products'))? 'active' : '' }}"><a
                                href="{{ route('web.allproduct') }}">Product</a></li>
                        @guest
                        <li class="{{ (request()->is('login'))? 'active' : '' }}">
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="{{ (request()->is('register'))? 'active' : '' }}">
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @else
                        <li class="has-children">
                            <a href="#">{{ Auth::user()->name }}</a>
                            <ul class="dropdown">
                                <li><a href="{{action('MedicalController@index')}}">My Medicel</a></li>
                                <li><a href="{{action('MedicalController@create')}}">Add Medicel</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </nav>
            </div>
            <div class="icons">
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block "><span
                class="icon-menu"></span></a>
          </div>

        </div>
    </div>
</div>
