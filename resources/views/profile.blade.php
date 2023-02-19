@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My Profile</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="user_form" method="POST" action="profile/edit">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{$user->id}}" />
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" value="{{$user->email}}" class="form-control" name="email" placeholder="Enter email" id="email" disabled>
                            </div>
                            <div class="form-group">
                                <label for="company">Company:</label>
                                <input type="text" value="{{$user->company}}" class="form-control" name="company" placeholder="Enter company name" id="company">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number:</label>
                                <input type="text" value="{{$user->phone}}" class="form-control" name="phone" placeholder="Enter phone number" id="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" value="{{$user->address}}" class="form-control" name="address" placeholder="Enter address" id="address">
                            </div>
                            <div class="form-group">
                                <label for="vat_number">Vat number:</label>
                                <input type="text" value="{{$user->vat_number}}" class="form-control" name="vat_number" placeholder="Enter vat number" id="vat_number">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password Change:</label>
                                <input type="checkbox" name="pwd" id="pwd">
                                <div class="password_box" style="width:40%; margin-left:30px; display:none;">
                                    <div class="form-group">
                                        <label for="current_pwd">Current Password:</label>
                                        <input type="password" class="form-control" name="current_pwd" placeholder="Enter current password" id="current_pwd">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_pwd">New Password:</label>
                                        <input type="password" class="form-control" name="new_pwd" placeholder="Enter new password" id="new_pwd">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_pwd">Confirm Password:</label>
                                        <input type="password" class="form-control" name="confirm_pwd" placeholder="Enter confirm password" id="confirm_pwd">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary update_profile">Update</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        
        $(document).on("click", "#pwd", function(){
            if ($(this)[0].checked) {
                $(".password_box").show();
            } else {
                $(".password_box").hide();
            }
        });
        $(document).on("click", ".update_profile", function(){
            console.log($("#pwd")[0].checked);
            if ($("#pwd")[0].checked) {
                var user_id = $("[name=user_id]").val();
                var current_pwd = $("#current_pwd").val();
                var new_pwd = $("#new_pwd").val();
                var confirm_pwd = $("#confirm_pwd").val();
                $.get(
                    "profile/checkPwd",
                    {
                        current_pwd: current_pwd,
                        user_id: user_id
                    }, function (res) {
                        if (res === "wrong") {
                            alert("Current password is wrong.");
                        } else if(res === "right") {
                            if (new_pwd === confirm_pwd) {
                                $(".user_form").submit();
                            } else {
                                alert("Password confirm does not match.");
                            }
                        }
                    }
                );
                console.log(current_pwd, new_pwd, confirm_pwd);
            } else {
                $(".user_form").submit();
            }
        });
    </script>
</div>
@endsection
