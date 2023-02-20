@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Invite User</div>
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
                    <form class="category_form" method="POST" action="{{ route('invite/add') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="flag" value="save" />
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <div class="form-group">
                            <label for="invited_email">Invite Email:</label>
                            <input type="text" class="form-control" name="invited_email" placeholder="Enter invite email" id="invited_email" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary invite_save">Invite</button>
                        <button type="button" class="btn btn-danger cancel_btn">Cancel</button>
                    </form>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invited Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invites_data as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->invited_email }}</td>
                                    <td>
                                        @if ($item->status==0)
                                            <span class="badge badge-secondary">Pending</span>
                                        @elseif ($item->status==1)
                                            <span class="badge badge-success">Active</span>
                                        @else 
                                            <span class="badge badge-dark">Expired</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-success text-white invite_resend_btn btn-sm" id="{{ $item->id }}">Resend</a>

                                        <a class="btn btn-danger text-white invite_delete_btn btn-sm" id="{{ $item->id }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", ".invite_delete_btn", function(){
            $.get(
                "invite/delete",
                {
                    id : $(this).attr('id')
                }, function(res){
                    window.location.reload();
                }
            )
        });
    </script>
</div>
@endsection
