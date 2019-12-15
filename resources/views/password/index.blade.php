@extends('layouts.app')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users Management</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Users Data</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left">
                                    <input value="{{ Session::get('userid') }}" id="id" class="form-control col-md-7 col-xs-12" name="id" placeholder="Id" type="hidden" disabled>
                                    @csrf
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9">
                                            <input value="{{ Session::get('username') }}" id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Name" required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9">
                                            <input value="{{ Session::get('email') }}" id="email" class="form-control col-md-7 col-xs-12" name="email" placeholder="Email" required="required" type="email">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9">
                                            <input value="{{ Session::get('password') }}" id="password" class="form-control col-md-7 col-xs-12" name="password" placeholder="Password" required="required" type="password">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                </form>
                                <div class="float-right">
                                    <button type="button" class="btn btn-warning" id="btn_update"> Update </button>
                                    <button type="button" class="btn btn-danger" id="btn_cancel"> Cancel </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btn_cancel").on("click", function() {
            location.reload();
        });

        $("#btn_update").on("click", function(e) {

            $.ajax({
                type: "POST",
                url: "{{ url('password/update') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: $("#id").val(),
                    name: $("#name").val(),
                    email: $("#email").val(),
                    password: $("#password").val()
                },

                success: function(response) {
                    console.log("Response: ", response);

                    if (response.code == "00") {
                        let data = response.data;
                        alert(response.message);
                        window.location.href = "{{ url('login') }}"
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log("Error: ", error);
                }
            });
        });
    });
</script>
@stop