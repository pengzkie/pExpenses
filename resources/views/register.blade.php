<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Form</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link href="{{ url('gentelella-master/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

	<link href="{{ url('gentelella-master/vendors/nprogress/nprogress.css') }} rel="stylesheet">

	<link href="{{ url('gentelella-master/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

	<link href="{{ url('gentelella-master/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
	<div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>

		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form class="form-horizontal form-label-left">
						<h1>Registration Form</h1>
						<div class="item form-group">
							<div class="col-md-12">
								<input id="email" type="email" name="email" class="form-control" maxlength="100" placeholder="Email Address">
							</div>
						</div>
						<div class="item form-group">
							<div class="col-md-12">
								<input id="name" type="text" name="name" class="form-control" maxlength="100" minlength="2" placeholder="Full Name (less than 2 characters)">
							</div>
						</div>
						<div class="item form-group">
							<div class="col-md-12">
								<input id="password" type="password" name="password" class="form-control" maxlength="24" placeholder="Password">
							</div>
						</div>
					</form>
					<div>
						<button class="btn btn-danger" id="btn_back">Back</button>
						<button class="btn btn-info" id="btn_submit">Submit</button>
					</div>
				</section>
			</div>
		</div>
	</div>
</body>

</html>

<script src="{{ url('gentelella-master/vendors/jquery/dist/jquery.min.js') }}" type="1830d5943da9a2ab8a29fcb3-text/javascript"></script>

<script src="{{ url('gentelella-master/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="1830d5943da9a2ab8a29fcb3-text/javascript"></script>

<script src="{{ url('gentelella-master/vendors/fastclick/lib/fastclick.js') }}" type="1830d5943da9a2ab8a29fcb3-text/javascript"></script>

<script src="{{ url('gentelella-master/vendors/nprogress/nprogress.js') }}" type="1830d5943da9a2ab8a29fcb3-text/javascript"></script>

<script src="{{ url('gentelella-master/vendors/validator/validator.js') }}" type="1830d5943da9a2ab8a29fcb3-text/javascript"></script>

<script src="{{ url('gentelella-master/build/js/custom.min.js') }} " type="1830d5943da9a2ab8a29fcb3-text/javascript"></script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="1830d5943da9a2ab8a29fcb3-|49" defer=""></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" language="javascript">
	$("#btn_submit").on("click", function() {

		if ($("#name").val() == "" || $("#password").val() == "" || $("#name")) {
			alert("Please check your inputs.");
			return;
		} else {

			var email = $("#email").val();

			if (!isEmail(email)) {
				alert("Please check your email address.");
				$("#email").focus();
				return;
			}

			if ($("#password").val().length < 6) {
				alert("Please check your password.");
				$("#password").focus();
				return;
			}

			$.ajax({
				type: "POST",
				url: "{{ url('login/validate_user') }}",
				data: {
					email: $("#email").val(),
					password: $("#password").val()
				},

				success: function(data) {
					var temp = $.parseJSON(data);
					//IF RESPONSE IS NULL
					if (temp == '') {
						alert("Log-in Failed. Please check your credentials.");
						return;
					}
					//SUCCESSFUL TRANSACTION.
					if (temp.code == '00') {
						alert("Successfully logged in.");
						window.location.href = "{{ url('admin/home') }}";
						return;
						//TRANSACTION FAILED
					} else {
						alert("Log-in Failed. Please check your credentials.");
						return;
					}
				}
			});
		}
    });
    
    $("#btn_back").on("click", function(){
        window.location.href = "{{ url('/') }}"
    });

	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
</script>