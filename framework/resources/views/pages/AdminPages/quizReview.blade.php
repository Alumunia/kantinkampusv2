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
<style>
    .logo p{
        display: inline-block;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alert</h4>
            </div>
            <div class="modal-body">
                Are You Sure? Once You Quit, You can not try the quiz any more
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class='btn btn-info pull-right' form="form-review-quiz" type="submit" name="saveAndSubmit" value="{{$saveAndGo}}" >Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Rules</h4>
            </div>
            <div class="modal-body">
                <li>Peserta dapat melakukan registrasi tanpa harus mengisi semua field (kecuali data Tim)  terlebih dahulu atau jika pada kondisi ingin merevisi data, kemudian mengklik SAVE pada halaman pengisian formulir.</li>

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
        <div class="well" style="background-image:url('assets/images/bg-1.png');position:fixed;z-index:3;width:210px;left:0px;">
            <label for="exampleInputEmail1">Username</label>
            <p style="font-size:14px">{{ Auth::guard('admin')->user()->username }}</p>
            <div style="font-size:12px" id="remain"><Strong>Sisa waktu</strong></div>
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal3">
                Rules
            </button>
        </div>
    </div>
    <!--/Announcement-->


    <div class='col-md-12' style='background-color: white'>
        <form method="POST" id='form-review-quiz' action="{{ url('/admin/quiz/quizReview') }}" onkeypress="return event.keyCode != 13;">
            {{ csrf_field() }}
            <ol style="font-weight:bold" start="{{$numbering}}">
                @foreach($quiz as $index => $quiz)
                <li>
                    <p style="margin-top:30px;size:15px">{!! $quiz->question !!}</p>
                    <!--Choices-->
                    <div>
                        @if (($user->$columns[$numbering+1+$index]) == 'A')
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="A" checked>
                        @else
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="A">
                        @endif
                        <label style='font-weight:normal'>
                            <div class="logo">
                                <p style="font-weight:bold">A. </p>
                                {!! $quiz->choices1 !!}
                            </div>
                        </label>
                    </div>
                    <div>
                        @if (($user->$columns[$numbering+1+$index]) == 'B')
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="B" checked>
                        @else
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="B">
                        @endif
                        <label style='font-weight:normal'>
                            <div class="logo">
                                <p style="font-weight:bold">B. </p>
                                {!! $quiz->choices2 !!}
                            </div>
                        </label>
                    </div>
                    <div>
                        @if (($user->$columns[$numbering+1+$index]) == 'C')
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="C" checked>
                        @else
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="C">
                        @endif
                        <label style='font-weight:normal'>
                            <div class="logo">
                                <p style="font-weight:bold">C. </p>
                                {!! $quiz->choices3 !!}
                            </div>
                        </label>
                    </div>
                    <div>
                        @if (($user->$columns[$numbering+1+$index]) == 'D')
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="D" checked>
                        @else
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="D">
                        @endif
                        <label style='font-weight:normal'>
                            <div class="logo">
                                <p style="font-weight:bold">D. </p>
                                {!! $quiz->choices4 !!}
                            </div>
                        </label>
                    </div>
                    <div>
                        @if (($user->$columns[$numbering+1+$index]) == 'E')
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="E" checked>
                        @else
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="E">
                        @endif
                        <label style='font-weight:normal'>
                            <div class="logo">
                                <p style="font-weight:bold">E. </p>
                                {!! $quiz->choices5 !!}
                            </div>
                        </label>
                    </div>
                    <div>
                        @if (($user->$columns[$numbering+1+$index]) == 'NU')
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="NU" checked>
                        @else
                        <input type="radio" name="jawaban{{$numbering+$index}}" id="optionsRadios1" value="NU">
                        @endif
                        <label style='font-weight:normal'>
                            <p>Kosongkan jawaban</p>
                        </label>
                    </div>
                </li>
                @endforeach
            </ol>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div><!--Content-->
            <!--Check current page-->
            <input type="hidden" name="theLastNumberInPageNow" value="{{$take}}">
            <input type="hidden" name="theFirstNumberInPageNow" value="{{$skip}}">
        </form>

        <!--Input to indentificate page now to score the input-->

        <input type="submit" name="hal" value="10" id="submit-form" value="submit" onPaste="" onkeydown="if (event.keyCode == 13)
                    return false;" class="hidden" />
        <!-- Button trigger modal -->
        <button type="button" style="margin-top:20px;border-radius:0px;" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#myModal9">
            Finish And Submit All
        </button>
        <nav>
            <ul class="pagination">
                @foreach($pagination as $pagination)
                @if(($saveAndGo) == $pagination)
                <li ><button style="border-radius:0px;" class="btn btn-warning active" form='form-review-quiz' name="saveAndGo" value="{{$pagination}}"  type="submit" value="submit">{{$pagination}}</button></li>
                @else
                <li><button style="border-radius:0px;" class="btn btn-warning" form='form-review-quiz' name="saveAndGo" value="{{$pagination}}"  type="submit" value="submit">{{$pagination}}</button></li>
                @endif
                @endforeach
            </ul>
        </nav>
    </div>
</div>



@endsection

