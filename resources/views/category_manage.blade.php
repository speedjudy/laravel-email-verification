@extends('layouts.app')

@section('content')
@include('layouts.secure')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category-manage</div>
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
                    <form class="category_form" method="POST" action="category_manage/add">
                        {{ csrf_field() }}
                        <input type="hidden" name="flag" value="save" />
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="category_id" value="" />
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <input type="text" class="form-control" name="category" placeholder="Enter category" id="category" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary category_save">Save</button>
                        <button type="button" class="btn btn-danger cancel_btn">Cancel</button>
                    </form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>
                                        <a class="btn btn-success text-white category_edit_btn" id="{{ $item->id }}">Edit</a>

                                        <a class="btn btn-danger text-white category_delete_btn" id="{{ $item->id }}">
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
        $(document).on("click", ".category_delete_btn", function(){
            $.get(
                "category_manage/delete",
                {
                    id : $(this).attr('id')
                }, function(res){
                    window.location.reload();
                }
            )
        });
        $(document).on("click", ".category_edit_btn", function(){
            var categodyId = $(this).attr('id');
            $("[name=flag]").val("edit");
            $(".category_save").text("Edit");
            $("[name=category_id]").val(categodyId);
            $("#category").val($(this).parent().parent().children()[1].innerText);
        });
        $(document).on("click", ".cancel_btn", function(){
            $("[name=flag]").val("save");
            $(".category_save").text("Save");
            $("[name=category_id]").val("");
            $("#category").val("");
        });
    </script>
</div>
@endsection
