@extends('layout.base', ['current' => 'products'])

@section('css')
  <link rel="stylesheet" href="{{asset('css/kartik-v/bootstrap-fileinput/fileinput.min.css')}}">
@endsection

@section('scripts')
  <script type="text/javascript" src="{{asset('js/igorescobar/jquery.mask.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/kartik-v/bootstrap-fileinput/fileinput.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/kartik-v/bootstrap-fileinput/themes/fas/theme.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/util/masks.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/util/image-uploader.js')}}"></script>
@endsection

@section('title', 'Products - New')

@section('header_title', 'Products')
@section('header_subtitle', 'New')

@section('header_button')
  <div class="form-inline float-right mt--1 d-none d-md-flex">
    <?php echo link_to_action('ProductController@index', "Back", null, ["class" => "btn btn-secondary mr-2"]); ?>
    {!! Form::submit('Save product', ['class'=>'btn btn-success', 'form' => 'form', 'files' => true]); !!}
  </div>
@endsection            

@section('content')
  {!! Form::open(['url' => '/products', 'method' => 'post', 'id' => 'form', 'enctype' => 'multipart/form-data']) !!}
    <div class="card">
      <div class="card-body">

        @if ($errors->any())
          <div class="alert alert-danger">
            Please, verify the error messages and try again.
          </div>
        @endif

        <div class="form-row">
          <div class="form-group col-md-3">
            {!! Form::file('image', ['class' => 'form-control ' . ($errors->has('image') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'image-input']); !!}
          
            @if ($errors->has('image'))
              <div class="invalid-feedback">
                {{$errors->first('image') }}
              </div>
            @endif
          </div>
          <div class="form-group col-md-9">
            {!! Form::label('name', 'Name'); !!}
            {!! Form::text('name', null, ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : ''), 'required'=> true, 'placeholder' => 'Name of the product', 'id' => 'name']); !!}
          
            @if ($errors->has('name'))
              <div class="invalid-feedback">
                {{$errors->first('name') }}
              </div>
            @endif
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('description', 'Description'); !!}
          {!! Form::textarea('description', null, ['class' => 'form-control ' . ($errors->has('description') ? 'is-invalid' : ''), 'required'=> true, 'placeholder' => 'Description...', 'id' => 'description']); !!}
        
          @if ($errors->has('description'))
            <div class="invalid-feedback">
              {{$errors->first('description') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          {!! Form::label('price', 'Price'); !!}
          {!! Form::text('price', null, ['class' => 'form-control money '. ($errors->has('price') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'price']); !!}
        
          @if ($errors->has('price'))
            <div class="invalid-feedback">
              {{$errors->first('price') }}
            </div>
          @endif
        </div>

        <div class="form-group">
          {!! Form::label('category_id', 'Category'); !!}
          {!! Form::select('category_id', $categories_options, null, ['class' => 'form-control ' . ($errors->has('category_id') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'category_id', 'placeholder' => '-- Select a category --']); !!}
        
          @if ($errors->has('category_id'))
            <div class="invalid-feedback">
              {{$errors->first('category_id') }}
            </div>
          @endif
        </div>
      </div>
    </div>
  {!! Form::close() !!}
@endsection
