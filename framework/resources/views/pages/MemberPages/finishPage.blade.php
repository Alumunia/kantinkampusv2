@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="col-md-6 col-md-offset-3" style="background-color:white">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>Thank you {{$choices->username}}</h3>
                <hr class="star-primary">
            </div>
        </div>

    </div>
</div>

@endsection