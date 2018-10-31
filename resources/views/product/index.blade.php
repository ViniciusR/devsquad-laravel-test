@extends('layout.base', ['current' => 'products'])

@section('title', 'Products - List')

@section('header_title', 'Products')
@section('header_subtitle', 'List')

@section('header_button')
  <div class="form-inline float-right mt--1 d-none d-md-flex">
    <a class="btn btn-success" href="/products/create">New product</a>
  </div>
@endsection            

@section('content')

<div class="card">
  <div class="card-body">

    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session()->get('success') }}
      </div>
    @endif

    <div class="container py-5 pl-0 pr-0">
      <div class="table-responsive">
        <table id="products-table" class="table">
          <thead class="text-left">
            <tr>
              <th scope="col"></th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Category</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>

          <tbody>
            @if (isset($products))
              @foreach($products as $product)
                <tr>
                  <td class="text-left"><img src="{{asset("storage/products/{$product->image}")}}" class="img-fluid" style="width: 100px; height: auto;"></td>
                  <td class="text-left">{{$product->name}}</td>
                  <td class="text-left">{{$product->description}}</td>
                  <td class="text-left">${{number_format((float)$product->price, 2, '.', '')}}</td>
                  <td class="text-left">{{$product->category->name}}</td>
                  <td class="text-left">
                    <div class="btn-group" role="group" aria-label="Actions">
                      <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <div class="form-group">
                            <?php echo link_to_action('ProductController@edit','Edit', $product->id, ['class' => 'btn btn-primary mr-1']); ?>
                           {!! Form::button('Delete', ['class' => 'btn btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Do you really wish to delete this product?")']); !!}
                          </div>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
        {{ $products->links() }}
      </div>
    </div>
  </div>
</div>
@endsection

