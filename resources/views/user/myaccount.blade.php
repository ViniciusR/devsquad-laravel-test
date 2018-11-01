@extends('layout.base')

@section('title', 'My account')

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/igorescobar/jquery.mask.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/util/masks.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/util/postal-code-check.js')}}"></script>
@endsection

@section('header_title', 'My account')

@section('header_button')
  <div class="form-inline float-right mt--1 d-none d-md-flex">
    {!! Form::submit('Save profile', ['class'=>'btn btn-success', 'form' => 'form', 'files' => true]); !!}
  </div>
@endsection    


@section('content')
@if ($errors->any())
  <div class="alert alert-danger">
    Please, verify the error messages and try again.
  </div>
@endif

@if(session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
@endif

<div class="card">
    <div class="card-header">{{ __('My account') }}</div>

    <div class="card-body">

        {!! Form::model($user, array('route' => array('users.update', $user->id), 'id' => 'form', 'method' => 'put')); !!}

            @method('PUT')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">
                    {!! Form::text('name', old('name', $user->name), ['class' => 'form-control ' . ($errors->has('name') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'name']); !!}

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">
                    {!! Form::text('email', old('email', $user->email), ['class' => 'form-control ' . ($errors->has('email') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'email']); !!}

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postal code') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">                                
                    {!! Form::text('postal_code', old('postal_code', $user->postal_code), ['class' => 'cep form-control ' . ($errors->has('postal_code') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'postal_code']); !!}

                    @if ($errors->has('postal_code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('postal_code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">                            
                    {!! Form::text('address', old('address', $user->address), ['class' => 'form-control ' . ($errors->has('address') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'address']); !!}

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Number') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">                                                            
                    {!! Form::number('number', old('number', $user->number), ['class' => 'form-control ' . ($errors->has('number') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'number']); !!}
                    
                    @if ($errors->has('number'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">
                
                    {!! Form::text('city', old('city', $user->city), ['class' => 'form-control ' . ($errors->has('city') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'city']); !!}

                    @if ($errors->has('city'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">                                                            
                    {!! Form::text('state', old('state', $user->state), ['class' => 'form-control ' . ($errors->has('state') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'state']); !!}

                    @if ($errors->has('state'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }} <i class="text-danger">*</i></label>

                <div class="col-md-6">
                    {!! Form::text('district', old('district', $user->district), ['class' => 'form-control ' . ($errors->has('district') ? 'is-invalid' : ''), 'required'=> true, 'id' => 'district']); !!}
                    
                    @if ($errors->has('district'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('district') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }} <i class="text-danger">*</i></strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>

             <div class="col-md-6 offset-md-4">
                 <span class="text-danger">* Required fields</span>
             </div>


            <div class="form-group row mb-0 mt-3">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        {!! Form::close(); !!}
    </div>
</div>
@endsection
