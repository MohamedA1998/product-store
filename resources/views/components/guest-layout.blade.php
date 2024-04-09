<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        @vite(['resources/js/app.js'])
        <title>Ecommerce | {{ $title ?? 'Signin' }}</title>
    </head>
    <body>
        
        {{ $slot }}

		
		<!--plugins-->
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
		<script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
		<script src="{{ asset('assets/js/perfect-scrollbar.js') }}"></script>
		<!--Password show & hide js -->
		<script>
			$(document).ready(function () {
				$("#show_hide_password a").on('click', function (event) {
					event.preventDefault();
					if ($('#show_hide_password input').attr("type") == "text") {
						$('#show_hide_password input').attr('type', 'password');
						$('#show_hide_password i').addClass("bx-hide");
						$('#show_hide_password i').removeClass("bx-show");
					} else if ($('#show_hide_password input').attr("type") == "password") {
						$('#show_hide_password input').attr('type', 'text');
						$('#show_hide_password i').removeClass("bx-hide");
						$('#show_hide_password i').addClass("bx-show");
					}
				});
			});
		</script>
		<!--app JS-->
		<script src="assets/js/app.js"></script>
    </body>
</html>
