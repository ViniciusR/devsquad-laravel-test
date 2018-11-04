<nav class="navbar navbar-expand-lg navbar-light bg-light  border-bottom shadow-sm">
  <div class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="navbar-brand text-uppercase" href="/">Vintage</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        @if (isset($categories))
          @foreach($categories as $category)
              <li @if(isset($current) && $current == $category->name) class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link text-uppercase" href="#"> {{$category->name}}</a>
              </li>
          @endforeach
        @endif
      </ul>

      <div class="row">
        <form class="form-inline">
          <div class="input-group">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <div class="input-group-text">
                  <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
              </div>
          </div>
          <a class="nav-link text-secondary" href="#"><i class="fas fa-shopping-cart fa-lg"></i></a>
        </form>

        <ul class="navbar-nav mr-auto">
          @guest
            <li class="nav-item text-uppercase">
                @if (Route::has('login'))
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Admin area') }}</a>
                @endif
            </li>
            <li class="nav-item text-uppercase">
                @if (Route::has('register'))
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </li>
          @else
            <li class="nav-item dropdown text-uppercase">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$user->name}}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                 <a class="dropdown-item text-uppercase" href="{{ route('myaccount') }}">My account</a>
                 <a class="dropdown-item text-uppercase" href="/products">Products</a>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item text-uppercase" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                 </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </div>
</nav>