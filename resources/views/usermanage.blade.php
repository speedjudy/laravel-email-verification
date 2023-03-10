@extends('layouts.app')

@section('content')
@include('layouts.secure')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User manage</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="button" class="btn btn-primary add_user_btn" data-toggle="modal" data-target="#addUserModal">
                        Add User
                    </button>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->permission)
                                            Administrator
                                        @else
                                            User
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->permission==0)
                                        <a class="btn btn-success text-white user_edit_btn btn-sm" data-toggle="modal" data-target="#addUserModal" id="{{ $user->id }}">Edit</a>

                                        <a class="btn btn-danger text-white user_delete_btn btn-sm" id="{{ $user->id }}">
                                            Delete
                                        </a>
                                        @else 
                                            <i>Admin</i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- The Modal -->
                    <div class="modal fade" id="addUserModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            
                                <!-- Modal Header -->
                                <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <form class="user_form" method="POST" action="usermanage/add">
                                <!-- Modal body -->
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="flag" value="save" />
                                        <input type="hidden" name="user_id" />
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="name" class="form-control" name="name" placeholder="Enter name" id="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email address:</label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter email" id="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="permission">Permission:</label>
                                            <select class="form-control" name="permission" id="permission">
                                                <option value="0">User</option>
                                                <option value="1">Administrator</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Password:</label>
                                            <input type="password" class="form-control" name="pwd" placeholder="Enter password" id="pwd" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", ".user_delete_btn", function(){
            console.log($(this).attr('id'));
            $.get(
                "usermanage/delete",
                {
                    id : $(this).attr('id')
                }, function(res){
                    window.location.reload();
                }
            )
        });
        $(document).on("click", ".user_edit_btn", function(){
            var userId = $(this).attr('id');
            $("[name=flag]").val("edit");
            $(".modal-title").text("Edit User");
            $("[name=user_id]").val(userId);
            $.get(
                "usermanage/getUser",
                {
                    id : userId
                }, function(res){
                    console.log(res);
                    if (res) {
                        $("#name").val(res[0].name);
                        $("#email").val(res[0].email);
                        $("#permission").val(res[0].permission);
                    }
                }, "json"
            );
        });
        $(document).on("click", ".add_user_btn", function(){
            $("[name=flag]").val("save");
            $(".modal-title").text("Add User");
            $("[name=user_id]").val("");
            $("#name").val("");
            $("#email").val("");
            $("#permission").val("");
        })
    </script>
</div>
@endsection
