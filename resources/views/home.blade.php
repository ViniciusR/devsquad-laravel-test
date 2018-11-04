<style type="text/css">

.page-header {
  background-image: url(/img/home-header.jpg) ;
  -webkit-background-size: cover; /* For WebKit*/
  -moz-background-size: cover;    /* Mozilla*/
  -o-background-size: cover;      /* Opera*/
  background-repeat: no-repeat;
  height: 500px;
  width: 100%;
}

/* Carousel base class */
.carousel {
  margin-bottom: 4rem;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  bottom: 3rem;
  z-index: 10;
}

/* Declare heights because of positioning of img element */
.carousel-item {
  height: 32rem;
  background-color: #FFF;
}
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}

.carousel-indicators li {
    background-color: lightgrey !important;
    width: 15px !important;
    height: 15px !important;
    border-radius: 100%;
    bottom:-60px;
}
.carousel-indicators .active {
    background-color: #000000 !important;
}

.carousel-inner {
   margin-bottom:50px;
}

.topbar {
  background: black;
}

</style>

@extends('layout.base', ['current' => 'home'])

@section('title', 'Home')

@section('topbar')
  <div class="topbar text-center pt-2">
    <h5 class="text-light"><strong>Free shipping<strong></h5>
  </div>
@endsection

@section('content')
  
  <div class="position-relative overflow-hidden p-3 pt-md-5 pb-md-5 mt-md-5 mb-md-2 text-left bg-light page-header text-light">
    <div class="p-lg-5 my-5">
      <h1 class="display-4 font-weight-normal mt-4 ml-5">Vintage Watches</h1>
      <h3 class="ml-5">A combination of beauty with perfection.</h3>
    </div>
  </div>

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">FEATURED</h1>
    <h3>For man</h3>
  </div>

  <div class="container">

      @if (isset($products))
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @for ($i = 0; $i < ceil($products->count() / 3); $i++)
          <li data-target="#myCarousel" data-slide-to="{{$i}}" @if ($i == 0) class="active" @else class="" @endif></li>
        @endfor
      </ol>
      <div class="carousel-inner">

        <?php $offset = 0; ?>

        @for ($page = 0; $page < ceil($products->count() / 3); $page++)
          <div @if ($page == 0) class="carousel-item active" @else class="carousel-item" @endif>
            <div class="row text-center mb-5">
              @for ($k = $offset; $k < ($products->count() < $offset+3 ? $products->count() : $offset+3); $k++)
                <div class="col-md-4 mt-4">
                  <div class="card" style="border: none;">
                    <img class="card-img-top img-fluid" src="{{asset("storage/products/{$products[$k]->image}")}}" data-holder-rendered="true" style="height: 350px; width: auto; display: block;">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <h5 class="card-title text-left">{{$products[$k]->name}}</h5>
                        </div>
                        <div class="col-6">
                            <h4 class="card-title pricing-card-title text-right"><strong>${{number_format((float)$products[$k]->price, 2, '.', '')}}</strong></h4>
                        </div>
                      </div>
                      <button type="button" class="btn btn-dark btn-lg mb-1 mt-3">
                        Add to cart
                      </button>  
                    </div>
                  </div>
                </div>
              @endfor
            </div>
          </div>
          <?php $offset += $page+3; ?>
        @endfor
      </div>
    </div>
  @endif

  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">FEATURED</h1>
    <h3>For woman</h3>
  </div>

  <div class="container">

      @if (isset($products))
        <div id="myCarousel2" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @for ($i = 0; $i < ceil($products->count() / 3); $i++)
              <li data-target="#myCarousel2" data-slide-to="{{$i}}" @if ($i == 0) class="active" @else class="" @endif></li>
            @endfor
          </ol>
          <div class="carousel-inner">

            <?php $offset = 0; ?>

            @for ($page = 0; $page < ceil($products->count() / 3); $page++)
              <div @if ($page == 0) class="carousel-item active" @else class="carousel-item" @endif>
                <div class="row text-center mb-5">
                  @for ($k = $offset; $k < ($products->count() < $offset+3 ? $products->count() : $offset+3); $k++)
                    <div class="col-md-4 mt-4">
                      <div class="card" style="border: none;">
                        <img class="card-img-top img-fluid" src="{{asset("storage/products/{$products[$k]->image}")}}" data-holder-rendered="true" style="height: 350px; width: auto; display: block;">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-6">
                              <h5 class="card-title text-left">{{$products[$k]->name}}</h5>
                            </div>
                            <div class="col-6">
                                <h4 class="card-title pricing-card-title text-right"><strong>${{number_format((float)$products[$k]->price, 2, '.', '')}}</strong></h4>
                            </div>
                          </div>
                          <button type="button" class="btn btn-dark btn-lg mb-1 mt-3">
                            Add to cart
                          </button>  
                        </div>
                      </div>
                    </div>
                  @endfor
                </div>
              </div>
              <?php $offset += $page+3; ?>
            @endfor
          </div>
        </div>
      @endif
    </div>

    <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center mb-3">
      <h1 class="display-4">Want 80% off?</h1>
      <p class="h2 mb-3">Subscribe below to get</p>
      <div class="form-group text-center">
        <input type="email" class="form-control input-lg" style="margin:auto; width: 300px;" placeholder="Email">
      </div>
      <button type="button" class="btn btn-dark btn-lg mb-1 mt-3">
        Subscribe
      </button>  
    </div>

  </div> <!-- /container -->
@endsection
