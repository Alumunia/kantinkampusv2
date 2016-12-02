@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Login</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class="col-md-6 col-md-offset-3" style="background-color:white">

        <form role="form" method="post" enctype="multipart/form-data" action="{{url("/login")}}" >
            {{ csrf_field() }}

            @foreach($fieldRegistration as $fieldRegistration)

            <div class="row control-group">
                <div class="form-group col-xs-12 floating-label-form-group controls ">
                    <label>{{$fieldRegistration->question}}</label>
                    <input type="{{$fieldRegistration->type_question}}" value="{{old($fieldRegistration->parameter_name)}}" class="form-control" required placeholder="{{$fieldRegistration->question}}" name="{{$fieldRegistration->parameter_name}}" required data-validation-required-message="silahkan masukkan {{$fieldRegistration->question}}"/>
                    @if ($errors->all())

                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first($fieldRegistration->parameter_name) }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @endforeach

            <br>

            <div id="success"></div>
            <div class="row">
                <div class="form-group col-xs-12">
                    <button style="border-radius: 0px; background-color: rgb(42, 202, 226); border-color: rgb(42, 202, 226);" type="submit" class="btn btn-info btn-lg pull-right">Login</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection