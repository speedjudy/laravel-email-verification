@extends('layouts.app')

@section('content')
<link
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
    rel="stylesheet"
/>
<style type="text/css">
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white !important;
        background-color: #0d6efd;
        padding: 0.2rem;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Sub page</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($subpage)
                        <form class="subpage_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                            <input type="hidden" name="subpage_id" value="{{$subpage[0]->id}}" />
                            <div class="form-group">
                                <label for="subpage_title">Title:</label>
                                <input type="text" class="form-control" value="{{$subpage[0]->title}}" name="subpage_title" placeholder="Enter Subpage title name" id="subpage_title" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea type="text" class="form-control" name="description" rows="5" placeholder="Enter description" id="description" disabled style="resize: none;">{{$subpage[0]->description}}</textarea>
                            </div>
                            <div class="form-group" style="width:30%;">
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" id="status" disabled>
                                    <option value="1">Active</option>
                                    @if ($subpage[0]->status==0)
                                        <option value="0" selected>Inactive</option>
                                    @else 
                                        <option value="0">Inactive</option>
                                    @endif
                                    @if ($subpage[0]->status==2)
                                        <option value="2" selected>Paused</option>
                                    @else 
                                        <option value="2">paused</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <input type="text" name="tags" value="{{$subpage[0]->tags}}" class="form-control p-4" data-role="tagsinput" disabled />
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
    
     </script>
</div>
@endsection
