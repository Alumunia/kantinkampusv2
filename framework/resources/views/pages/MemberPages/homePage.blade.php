@extends('layouts.layout')

@section('content')
<!-- Header -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif

<!-- Header -->

<div style="padding-top: 20px" class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Join</h2>
                <hr class="star-primary">
            </div>
        </div><!--./row-->
        <div class="row">
            <div class="bs-example" data-example-id="thumbnails-with-custom-content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img data-src="{{asset('framework/images/holder.svg')}}" alt="Generic placeholder thumbnail">
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p><a href="#" class="btn btn-primary" role="button">Beli</a> <a href="#" class="btn btn-default" role="button">Kirim pesan</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img data-src="{{asset('framework/images/holder.svg')}}" alt="Generic placeholder thumbnail">
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p><a href="#" class="btn btn-primary" role="button">Beli</a> <a href="#" class="btn btn-default" role="button">Kirim pesan</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img data-src="holder.js/100%x200" alt="Generic placeholder thumbnail">
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p><a href="#" class="btn btn-primary" role="button">Beli</a> <a href="#" class="btn btn-default" role="button">Kirim pesan</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img data-src="holder.js/100%x200" alt="Generic placeholder thumbnail">
                            <div class="caption">
                                <h3>Thumbnail label</h3>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.bs-example -->
        </div><!--./rows-->
    </div>
    <!--<div id="countdown"></div>-->
    <!--    <h4 align='center'>On The Way To Competition</h4>
        <div class="progress">
            <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%">
                <span class="sr-only">{{$progress}}% Complete</span>
            </div>
        </div>-->
</div>

<!--
<script>
    var days = {{$day}}, hours = {{$hour}}, minutes = {{$minute}}, seconds = {{$second}};

    var container = document.getElementById("countdown");

    function countdown() {
        if (seconds == 0) {
            seconds = 59;
            minutes--;
        } else {
            seconds--;
        }
        if (minutes == -1) {
            minutes = 59;
            hours--;
        }
        if (hours == -1) {
            days--;
        }
        container.innerHTML = "days:" + days + ", hours:" + hours + ", minutes:" + minutes + ", seconds:" + seconds;
        setTimeout(countdown, 1000);

    }

    countdown();
</script>-->


@endsection