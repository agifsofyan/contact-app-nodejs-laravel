<!DOCTYPE html>
<html>
<head>
	<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<title>@yield('title')</title>
</head>
<body class="container">
		
	<content>
		@yield('content')
	</content>

    <script type="text/javascript">
    	$(document).ready(function(){
			$('.dropdown-content').modal();
			$('.dropdown-trigger').dropdown({
				hover: true,
				constrainWidth: false
			});

			$('.modal').modal();
		});
    </script>

    @yield('script')
</body>
</html>