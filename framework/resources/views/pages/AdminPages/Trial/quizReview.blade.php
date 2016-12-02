@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif
<style>
    p {
        font-size:17px;
    }
</style>
<script type="text/javascript" src="assets/dist/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var days = 15
    var hours = 12
    var minutes = 12
    var seconds = 12
    function setCountDown()
    {
        seconds--;
        if (seconds < 0) {
            minutes--;
            seconds = 59
        }
        if (minutes < 0) {
            hours--;
            minutes = 59
        }
        if (hours < 0) {
            days--;
            hours = 23
        }
        document.getElementById("remain").innerHTML = hours + " hours, " + minutes + " minutes, " + seconds + " seconds";
        SD = window.setTimeout("setCountDown()", 1000);
        if (hours == '00' && minutes == '00' && seconds == '00') {
            seconds = "00";
            window.clearTimeout(SD);

            window.location = "process/finish.php?done" // Add your redirect url
        }

    }

</script>
<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rules</h4>
            </div>
            <div class="modal-body">
                <li>   Peserta dapat melakukan registrasi tanpa harus mengisi semua field (kecuali data Tim)  terlebih dahulu atau jika pada kondisi ingin merevisi data, kemudian mengklik SAVE pada halaman pengisian formulir.</li>

                <li>Namun, pengisian form dianggap sempurna serta akun akan dinyatakan valid dan bisa mengikuti online test apabila telah melengkapi seluruh formulir berdasarkan syarat dan ketentuan yang berlaku lalu mengklik SUBMIT. </li>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!--/The end of Modal-->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Review quiz</h2>
            <hr class="star-primary">
        </div>
    </div>
    <!--Announcement-->
    <div class='col-md-12'>
        <div class="well pull-right" style="background-image:url('assets/images/bg-1.png');position:fixed;z-index:3;width:210px;right:0px;">
            <p style="font-size:14px"><Strong>Username :</strong></p>
            <div style="font-size:12px" id="remain"><Strong>Sisa waktu</strong></div>
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal3">
                Rules
            </button>
        </div>
    </div>
    <!--/Announcement-->
    <ol style="font-weight:bold" start='{{$numbering}}'>
        <div class='col-md-12' style='background-color: white'>
            <form method="POST" id='form-review-quiz' action="{{ url('/admin/quiz/quizReview') }}" onkeypress="return event.keyCode != 13;">
                {{ csrf_field() }}
                <ol>
                    @foreach($quiz as $index => $quiz)
                    <li>
                        <p style="margin-top:30px;size:15px">{!! $quiz->question !!}</p>
                        <!--Choices-->
                        <div>
                            <input type="radio" name="{{$index+1}}" id="optionsRadios1" value="option1" checked>
                            <label>
                                {!! $quiz->choices1 !!}
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="{{$index+1}}" id="optionsRadios1" value="option1" >
                            <label>
                                {!! $quiz->choices2 !!}
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="{{$index+1}}" id="optionsRadios1" value="option1" >
                            <label>
                                {!! $quiz->choices3 !!}
                            </label>
                        </div>
                        <div >
                            <input type="radio" name="{{$index+1}}" id="optionsRadios1" value="option1" >
                            <label>
                                {!! $quiz->choices4 !!}
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="{{$index+1}}" id="optionsRadios1" value="option1" >
                            <label>
                                {!! $quiz->choices5 !!}
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="{{$index+1}}" id="optionsRadios1" value="option1" >
                            <label>
                                Kosongkan jawaban
                            </label>
                        </div>
                    </li>
                    @endforeach
                </ol>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div><!--Content-->
            </form>
            <nav>
                <ul class="pagination">
                    @foreach($pagination as $pagination)
                    <li><button style="border-radius:0px;" class="btn btn-info" form='form-review-quiz' name="saveAndGo" value="{{$pagination}}"  type="submit" value="submit">{{$pagination}}</button></li>
                    @endforeach
                </ul>
            </nav>
        </div>
</div>



@endsection

