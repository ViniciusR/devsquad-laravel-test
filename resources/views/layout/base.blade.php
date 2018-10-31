<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    @hasSection('css')
		@yield('css')
	@endif

	<title>@yield('title')</title>
</head>
<body>

	@component('component.navbar', ['current' => $current, 'categories' => $categories])
	@endcomponent

	<div class="container">
		<main role="main">
			@hasSection('header_title')

				<div class="pb-2 mt-4 mb-2border-bottom">
				  @hasSection('header_button')
				  	 @yield('header_button')
				  @endif

				  <h1 class="h2">@yield('header_title')</h1>

				  @hasSection('header_subtitle')
				  	<h4 class="h4">@yield('header_subtitle')</h4>
			  	  @endif
				</div>
			@endif

			@hasSection('content')
				@yield('content')
			@endif
		</main>

		<div class="fixed-bottom d-flex justify-content-end" style="margin-bottom: 60px; margin-right: 40px;">
			<div class="circle d-flex justify-content-center align-items-center">
				<a href="#" class="text-dark"><i class="fa fa-chevron-up fa-2x"></i></a>
			</div>
		</div>
	</div>

	@component('component.footer', ['categories' => $categories])
	@endcomponent

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
	@hasSection('scripts')
		@yield('scripts')
	@endif

</body>
</html>