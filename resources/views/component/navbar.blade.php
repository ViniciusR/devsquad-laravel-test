<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
  <div class="container d-flex flex-column flex-md-row justify-content-between">
    <a class="navbar-brand" href="/">Badge</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        @if (isset($categories))
          @foreach($categories as $category)
              <li @if($current == $category->name) class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="#"> {{$category->name}}</a>
              </li>
          @endforeach
        @endif
      </ul>

      <div class="d-flex flex-column flex-md-row justify-content-end align-items-center">
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          <a class="nav-link text-secondary" href="#"><i class="fas fa-shopping-cart fa-2x"></i></a>
        </form>

        <ul class="navbar-nav mr-auto">
          @if(!$user)
            <li><a class="nav-link text-secondary" href="/login">Admin area</a></li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{$user->name}}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                 <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                 </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</nav>