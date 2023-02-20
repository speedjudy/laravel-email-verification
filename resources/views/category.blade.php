@extends('layouts.app')

@section('content')
@include('layouts.secure')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/subpage/edit/{{$category_id}}">
                        <button type="button" class="btn btn-primary create_new_widget">
                            Create new subpage
                        </button>
                    </a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $subpage)
                                <tr>
                                    <td><a href="/subpage/view/{{$subpage->id}}">{{ $subpage->title }}</a> <br> <i>{{ $subpage->created_at }}</i></td>
                                    <td>
                                        @if ($subpage->status==0)
                                            <span class="badge badge-secondary">Inactive</span>
                                        @elseif ($subpage->status==1)
                                            <span class="badge badge-success">Active</span>
                                        @else 
                                            <span class="badge badge-dark">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                    @if (Auth::user()->permission)
                                        <a href="/subpage/edit/{{$subpage->category_id}}/{{$subpage->id}}" class="btn btn-success text-white btn-sm">Edit</a>
                                        <a href="/subpage/delete/{{$subpage->id}}" class="btn btn-danger text-white btn-sm">Delete</a>
                                    @else
                                        <i>User can only review</i>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
