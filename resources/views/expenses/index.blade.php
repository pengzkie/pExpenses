@extends('layouts.app')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Expenses Management</h3>
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
                                <h2>Expenses Data</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" novalidate>
                                    <input value="" id="id" class="form-control col-md-7 col-xs-12" name="id" placeholder="Id" type="hidden" disabled>
                                    @csrf
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Amount <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9">
                                            <input value="" id="amount" class="form-control col-md-7 col-xs-12 int" name="amount" placeholder="Amount" required="required" type="text">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 ">Select Category</label>
                                        <div class="col-md-9 col-sm-9">
                                            <select class="form-control col-md-7 col-xs-12" id="category_id">
                                                @if(!empty($categoryData))
                                                @foreach($categoryData as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
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
                                <h2>Expenses List</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">Action </th>
                                        <th class="column-title">Amount </th>
                                        <th class="column-title">Category </th>
                                        <th class="column-title">Date </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($expensesData))
                                        @foreach($expensesData as $expenses)
                                        <tr class="even pointer">
                                            <td class="" style="width:15%">
                                                <button data-id="{{ $expenses->id }}" class="btn btn-info btn_edit"> Edit</button>
                                                <button data-id="{{ $expenses->id }}" class="btn btn-danger btn_delete"> Delete</button>
                                            </td>
                                            <td class="">{{ $expenses->amount }}</td>
                                            <td class="">{{ $expenses->category_name }}</td>
                                            <td class="">{{ $expenses->created_date }}</td>
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
    
    $(".int").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 110, 190]) !== -1 ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $(".alphabet").keydown(function (evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which);

        if ((charCode >= 65 && charCode <= 90)          // UPPERCASE LETTER
            // || (charCode >= 48 && charCode <= 57)       // NUMBERS
            || (charCode >= 97  && charCode <= 122)     // LOWERCASE LETTER
            || (charCode == 8)                          // BACKSPACE
            || (charCode == 32)                         // SPACE
            || (charCode == 9)                          // HORIZONTAL TAB
            || (charCode >= 37 && charCode <= 40)    // ARROW KEY
            || charCode == 0 )                          // Null char
        {
            return true;
        }
        return false;
    });

    $("#btn_cancel").on("click", function() {
        location.reload();
    });

    $("#btn_add").on("click", function(e) {

        if($("#amount").val() == "" || $("#category_id").val() == ""){
            alert("Please check your inputs");
            return;
        }

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('expenses/add') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                amount: $("#amount").val(),
                category_id: $("#category_id").val(),
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
            url: "{{ url('expenses/delete') }}",
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
            url: "{{ url('expenses/fetch_data') }}",
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
                    $("#amount").val(data[0]['amount']);
                    $("#category_id").val(data[0]['category_id']);
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
        
        if($("#amount").val() == "" || $("#category_id").val() == ""){
            alert("Please check your inputs");
            return;
        }
        
        $.ajax({
            type: "POST",
            url: "{{ url('expenses/update') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: $("#id").val(),
                amount: $("#amount").val(),
                category_id: $("#category_id option:selected").val()
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