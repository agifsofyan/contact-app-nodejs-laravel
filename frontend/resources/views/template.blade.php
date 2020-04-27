<!DOCTYPE html>
<html>
<head>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
	<title>@yield('title')</title>
</head>
<body class="container">
		
	@if ( Session::has('flash_message') )            
		<div class="alert {{ Session::get('flash_type') }}">
			<script>
				M.toast({html: '{{ Session::get('flash_message') }}', classes: 'rounded', displayLegth: 1000, timeRemaining: 2000})
			</script>
	  		<h3></h3>
		</div>
	@endif

	<content>
		@yield('content')
	</content>

	<style type="text/css">
		.full {
			width: 100%; 
			max-height: 100%; 
			margin: auto !important; 
			top: 0px !important;
			bottom: 0px !important;
			padding: 20px;
		}

		.confirm {
			width: 28%; 
			max-height: 28%; 
			margin: auto !important; 
			top: 0px !important;
			bottom: 0px !important;
			padding: 20px;
			border: none !important;
			box-shadow: none !important;
		}

		.error {
			color: #f44336;
		}

		span.error {
			margin-left: 45px;
		}
	</style>

    <script type="text/javascript">
    	$(document).ready(function(){
			$('.dropdown-content').modal();
			$('.dropdown-trigger').dropdown({
				hover: true,
				constrainWidth: false
			});

			$('.tooltipped').tooltip();

			$('.modal').modal();

			$('.datepicker').datepicker({
				autoClose:true,
				editable: true,
				selectMonths: true,
        		selectYears: 15,
				format:'yyyy/mm/dd'
			}).dblclick(function(){
		    	$(this).pickadate('picker').set(moment.now());
		    });
		});
    </script>
</body>
</html>