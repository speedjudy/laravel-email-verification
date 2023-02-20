@extends('layouts.app')

@section('content')
@include('layouts.secure')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                    <div class="panel-body" style="over-flow:auto;">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            
                        <div class="card-columns">
                            @foreach ($categories as $category)
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <img class="card-img-top" src="images/images.jpg" width="70" alt="Card image">
                                        <p class="card-text"><a href="/cate/<?php echo str_replace(" ", "-", $category->category);?>/{{$category->user_id}}/{{$category->id}}">{{ $category->category }}</a></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
