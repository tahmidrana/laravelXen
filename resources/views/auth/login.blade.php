<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />

	<title>Xenon - Login Light</title>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
	<link rel="stylesheet" href="{{ asset('assets/css/fonts/linecons/css/linecons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/fonts/fontawesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/xenon-core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/xenon-forms.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/xenon-components.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/xenon-skins.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

	<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body login-page login-light">

	
	<div class="login-container">
	
		<div class="row">
	
			<div class="col-sm-6 col-md-offset-3">
	
				<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						// Reveal Login form
						setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);
	
	
						// Validation and Ajax action
						$("form#login").validate({
							rules: {
								xe_username: {
									required: true
								},
	
								xe_passwd: {
									required: true
								}
							},
	
							messages: {
								xe_username: {
									required: 'Please enter your username.'
								},
	
								xe_passwd: {
									required: 'Please enter your password.'
								}
							},
	
							// Form Processing via AJAX
							submitHandler: function(form)
							{
								show_loading_bar(70); // Fill progress bar to 70% (just a given value)
	
								var opts = {
									"closeButton": true,
									"debug": false,
									"positionClass": "toast-top-full-width",
									"onclick": null,
									"showDuration": "300",
									"hideDuration": "1000",
									"timeOut": "5000",
									"extendedTimeOut": "1000",
									"showEasing": "swing",
									"hideEasing": "linear",
									"showMethod": "fadeIn",
									"hideMethod": "fadeOut"
								};
	
								$.ajax({
									url: "{{ url('/login') }}",
									method: 'POST',
									dataType: 'json',
									data: {
										do_login: true,
										username: $(form).find('#xe_username').val(),
										passwd: $(form).find('#xe_passwd').val(),
										_token: $('#token').val()
									},
									success: function(resp)
									{
										show_loading_bar({
											delay: .5,
											pct: 100,
											finish: function(){
	
												// Redirect after successful login page (when progress bar reaches 100%)
												if(resp.accessGranted)
												{
													url = '<?= redirect()->intended("/")->getTargetUrl() ?>'
													window.location.href = url;
												}
											}
										});
	
										
										// Remove any alert
										$(".errors-container .alert").slideUp('fast');
	
	
										// Show errors
										if(resp.accessGranted == false)
										{
											$(".errors-container").html('<div class="alert alert-danger">\
												<button type="button" class="close" data-dismiss="alert">\
													<span aria-hidden="true">&times;</span>\
													<span class="sr-only">Close</span>\
												</button>\
												' + resp.errors + '\
											</div>');
	
	
											$(".errors-container .alert").hide().slideDown();
											$(form).find('#passwd').select();
										}
									}
								});
	
							}
						});
	
						// Set Form focus
						$("form#login .form-group:has(.form-control):first .form-control").focus();
					});
				</script>
	
				<!-- Errors container -->
				<div class="errors-container">
	
					
				</div>
	
				<!-- Add class "fade-in-effect" for login form effect -->
				<form method="post" role="form" id="login" class="login-form fade-in-effect">
					<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	
					<div class="login-header text-center">
						<a href="#" class="logo">
							<img src="{{ asset('') }}assets/images/logo-white-bg@2x.png" alt="" width="80" />
						</a>
	
						<p>Dear user, log in to access the admin area!</p>
					</div>
	
	
					<div class="form-group">
						<label class="control-label" for="xe_username">Username</label>
						<input type="text" class="form-control" name="xe_username" id="xe_username" autocomplete="off" />
					</div>
	
					<div class="form-group">
						<label class="control-label" for="passwd">Password</label>
						<input type="password" class="form-control" name="xe_passwd" id="xe_passwd" autocomplete="off" />
					</div>
	
					<div class="form-group">
						<button type="submit" class="btn btn-primary  btn-block text-left">
							<i class="fa-lock"></i>
							Log In
						</button>
					</div>
	
					<div class="login-footer">
						<a href="#"></a>
	
						<div class="info-links">
							<a href="#">ToS</a> -
							<a href="#">Privacy Policy</a>
						</div>
	
					</div>
	
				</form>	
			</div>
	
		</div>
	
	</div>



	<!-- Bottom Scripts -->
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
	<script src="{{ asset('assets/js/resizeable.js') }}"></script>
	<script src="{{ asset('assets/js/joinable.js') }}"></script>
	<script src="{{ asset('assets/js/xenon-api.js') }}"></script>
	<script src="{{ asset('assets/js/xenon-toggles.js') }}"></script>
	<script src="{{ asset('assets/js/jquery-validate/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('assets/js/toastr/toastr.min.js') }}"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/xenon-custom.js"></script>

</body>
</html>