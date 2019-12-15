@extends('layouts.app')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Category Management</h3>
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
                                <h2>Category Data</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" novalidate>
                                    <input value="" id="id" class="form-control col-md-7 col-xs-12" name="id" placeholder="Id" type="hidden" disabled>
                                    @csrf
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Name <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9">
                                            <input value="" id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Name" required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                </form>
                                <div class="float-right">
                                    <button type="button" class="btn btn-primary" id="btn_add"> Add </button>
                                    <button type="button" class="btn btn-warning" id="btn_update" disabled style="display:none;"> Update </button>
                                    <button type="button" class="btn btn-danger" id="btn_cancel"> Cancel </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Category List</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">Action </th>
                                        <th class="column-title">Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($categoryData))
                                        @foreach($categoryData as $category)
                                        <tr class="even pointer">
                                            <td class="" style="width:30%">
                                                <button data-id="{{ $category->id }}" class="btn btn-info btn_edit"> Edit</button>
                                                <button data-id="{{ $category->id }}" class="btn btn-danger btn_delete"> Delete</button>
                                            </td>
                                            <td class="">{{ $category->name }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
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
$( document ).ready(function() {
    $("#btn_cancel").on("click", function() {
        location.reload();
    });

    $("#btn_add").on("click", function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('category/add') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                name: $("#name").val()
            },

            success: function(response) {
                console.log("Response: ", response);

                if(response.code == "00"){
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(error){
                console.log("Error: ", error);
            }
        });
    });

    $(".btn_delete").on("click", function(e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{ url('category/delete') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },

            success: function(response) {
                console.log("Response: ", response);

                if(response.code == "00"){
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(error){
                console.log("Error: ", error);
            }
        });
    });

    $(".btn_edit").on("click", function(e) {
        
        let id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{ url('category/fetch_data') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id
            },
            beforeSend: function(){
                
                $("#btn_update").prop("disabled", false);
                $("#btn_update").show();
                $("#btn_add").prop("disabled", true);
                $("#btn_add").hide();
            },
            success: function(response) {
                console.log("Response: ", response);
                
                if(response.code == "00"){
                    let data = response.data;

                    $("#id").val(data[0]['id']);
                    $("#name").val(data[0]['name']);
                } else {
                    alert(response.message);
                }
            },
            error: function(error){
                console.log("Error: ", error);
            }
        });
    });

    $("#btn_update").on("click", function(e) {
        
        $.ajax({
            type: "POST",
            url: "{{ url('category/update') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: $("#id").val(),
                name: $("#name").val()
            },

            success: function(response) {
                console.log("Response: ", response);
                
                if(response.code == "00"){
                    let data = response.data;
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(error){
                console.log("Error: ", error);
            }
        });
    });
});
</script>
@stop