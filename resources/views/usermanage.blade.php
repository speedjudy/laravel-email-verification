@extends('layouts.app')

@section('content')
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
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
                                        <a class="btn btn-success text-white" href="">Edit</a>

                                        <a class="btn btn-danger text-white user_delete_btn" id="{{ $user->id }}">
                                            Delete
                                        </a>
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
                                
                                <form method="POST" action="usermanage/add">
                                <!-- Modal body -->
                                    <div class="modal-body">
                                        {{ csrf_field() }}
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
        })
    </script>
</div>
@endsection
