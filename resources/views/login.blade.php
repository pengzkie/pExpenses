<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In Form</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="{{ url('gentelella-master/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ url('gentelella-master/vendors/nprogress/nprogress.css') }} rel=" stylesheet">

    <link href="{{ url('gentelella-master/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <link href="{{ url('gentelella-master/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>
        {{ $roleData ?? '' }}
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form class="form-horizontal form-label-left">
                        <h1>Log-in Form</h1>
                        @csrf
                        <div class="item form-group">
                            <div class="col-md-12">
                                <input id="email" type="email" name="email" class="form-control" maxlength="100" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="item form-group">
                            <div class="col-md-12">
                                <input id="password" type="password" name="password" class="form-control" maxlength="24" placeholder="Password">
                            </div>
                        </div>
                    </form>
                    <div>
                        <!-- <button class="btn btn-primary" id="btn_register">Register</button> -->
						<button class="btn btn-danger" id="btn_reset">Reset</button>
                        <button class="btn btn-info" id="btn_login">Log-in</button>
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
    $("#btn_login").on("click", function() {

        if ($("#email").val() == "" || $("#password").val() == "") {
            alert("Please check your inputs.");
            return;
        } else {

            if (!isEmail($("#email").val())) {
                alert("Please check your email address.");
                $("#email").focus();
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ url('login/fetch_data') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: $("#email").val(),
                    password: $("#password").val()
                },

                success: function(response) {
                    //IF RESPONSE IS NULL
                    if (response == '') {
                        alert("Log-in Failed. Please check your credentials.");
                        return;
                    }

                    //SUCCESSFUL TRANSACTION.
                    if (response.code == '00') {
                        window.location.href = "{{ url('home') }}";
                        alert(response.message);
                        return;
                        //TRANSACTION FAILED
                    } else {
                        alert(response.message);
                        return;
                    }
                }
            });
        }
    });

    $("#btn_register").on("click", function() {
        window.location.href = "{{ url('register') }}";
    })

    $("#btn_reset").on("click", function() {
        location.reload();
    })

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>