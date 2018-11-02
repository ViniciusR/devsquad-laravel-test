@extends('layout.base', ['current' => 'products'])

@section('title', 'Product - View')
     
@section('content')
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-5">
          <img src="{{asset("storage/products/{$product->image}")}}" class="img-fluid ml-3 mt-5 mb-3" style="width: 250px; height: auto;">
        </div>
        <div class="col-7 mt-5">    

          <h1 class="mb-4">{{$product->name}}</h1>
          <h4>$ {{ number_format($product->price, 2, ',', '.')}}</h4>

          <h5 class="mt-4 text-muted">Quantity</h5>
          <div class="form-group col-lg-2 pl-0">
            <input class="form-control ml-0" type="number" value = 1>
          </div>

          <h5 class="mb-4 mt-4 text-muted">{{$product->description}}</h5>
          <h5 class="mb-6 mt-4"><span class="badge badge-dark">{{$product->category->name}}</span></h5>

          <button type="button" class="btn btn-dark btn-lg mb-1 mt-5">
            Add to cart
          </button>   
          
        </div>
      </div>
    </div>      
  </div>      
@endsection
