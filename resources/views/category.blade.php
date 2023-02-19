@extends('layouts.app')

@section('content')
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
                    
                    <a href="{{ route('subpage') }}">
                        <button type="button" class="btn btn-primary create_new_widget">
                            Create new category
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
                            @foreach ($categories as $category)
                                <tr>
                                    <td><a href="/subpage/view/{{$category->id}}">{{ $category->title }}</a></td>
                                    <td>
                                        @if ($category->status==0)
                                            <span class="badge badge-secondary">Inactive</span>
                                        @elseif ($category->status==1)
                                            <span class="badge badge-success">Active</span>
                                        @else 
                                            <span class="badge badge-dark">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/subpage/{{$category->id}}" class="btn btn-success text-white">Edit</a>
                                        <a href="/subpage/delete/{{$category->id}}" class="btn btn-danger text-white">Delete</a>
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
