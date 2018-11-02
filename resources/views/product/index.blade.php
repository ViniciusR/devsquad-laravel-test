@extends('layout.base', ['current' => 'products'])

@section('css')
  <link rel="stylesheet" href="{{asset('css/kartik-v/bootstrap-fileinput/fileinput.min.css')}}">
@endsection

@section('scripts')
  <script type="text/javascript" src="{{asset('js/kartik-v/bootstrap-fileinput/fileinput.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/kartik-v/bootstrap-fileinput/themes/fas/theme.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/util/image-uploader.js')}}"></script>
@endsection

@section('title', 'Products - List')

@section('header_title', 'Products')
@section('header_subtitle', 'List')

@section('header_button')
  <div class="form-inline float-right mt--1 d-none d-md-flex">
    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#importCSVModal">
      Import products
    </button>
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
                  <td class="text-left" style="width: 15%"><img src="{{asset("storage/products/{$product->image}")}}" class="img-fluid" style="width: 100px; height: auto;"></td>
                  <td class="text-left" style="width: 20%">{{$product->name}}</td>
                  <td class="text-left" style="width: 20%">{{$product->description}}</td>
                  <td class="text-left" style="width: 15%">${{number_format((float)$product->price, 2, '.', '')}}</td>
                  <td class="text-left" style="width: 10%"><span class="badge badge-dark">{{$product->category->name}}</span></td>
                  <td class="text-left" style="width: 15%">
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

<!-- Modal -->
<div class="modal fade" id="importCSVModal" tabindex="-1" role="dialog" aria-labelledby="importCSVModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importCSVModalLabel">Upload CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('products.uploadCSV') }}" id="form-csv" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
          {!! Form::file('csv', ['class' => 'form-control']); !!}
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="form-csv" class="btn btn-primary" files>Import</button>
      </div>
    </div>
  </div>
</div>
@endsection

