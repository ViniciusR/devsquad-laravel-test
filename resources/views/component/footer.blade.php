<footer class="footer pt-4 pt-md-5 border-top bg-dark text-light text-uppercase">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md">
        <p class="d-block mb-3 text-light">A product of</p>
        <h3>Vintage</h3>
        <p class="d-block mb-3 text-light">Collection</p>
      </div>
      <div class="col-6 col-md">
        <h4>About</h4>
        <ul class="list-unstyled text-small mt-3">
          <li><a class="text-light" href="#">Our mission</a></li>
          <li><a class="text-light" href="#">About us</a></li>
          <li><a class="text-light" href="#">Reviews</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h4>Menu</h4>
        <ul class="list-unstyled text-small mt-3">
          @if (isset($categories))
            @foreach($categories as $category)
                <li><a class="text-light" href="#"> {{$category->name}}</a></li>
            @endforeach
          @endif
        </ul>
      </div>
      <div class="col-6 col-md">
        <h4>Social media</h4>
        <ul class="list-inline mt-3">
          <li class="list-inline-item mr-3">
            <div class="circle d-flex justify-content-center align-items-center">
              <a href="#" class="text-dark"><i class="fab fa-facebook fa-2x"></i></a>
            </div>
          <li class="list-inline-item  mr-3">
            <div class="circle d-flex justify-content-center align-items-center">
              <a href="#" class="text-dark"><i class="fab fa-twitter fa-2x"></i></a>
            </div>
          </li>
          <li class="list-inline-item">
            <div class="circle d-flex justify-content-center align-items-center">
              <a href="#" class="text-dark"><i class="fab fa-youtube fa-2x"></i></a>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-9 col-md-9">
        <p><small>support@vincerowatches.com</small></p>
      </div>
      <div class="col-3 col-md-3">
        <p><small>2018 Vintage - All rights reserved.</small></p>
      </div>
    </div>
  </div>
</footer>