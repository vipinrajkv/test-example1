<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<link href="{{ asset('js/adminStyle.js') }}" rel="stylesheet" />
<link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet" />
@vite(['resources/adminStyle.css'])
<!------ Include the above in your HEAD tag ---------->
<div class="check"></div>
<div id="app">

	{{-- <app></app> --}}
	<dashboard_main></dashboard_main>

  </div>

  {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
  @vite(['resources/js/app.js'])




