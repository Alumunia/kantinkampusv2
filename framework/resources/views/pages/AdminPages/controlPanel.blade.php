@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Control Room</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class='col-md-12' style='background-color: white'>
        <div class='row'>
            <div class='col-md-12'>
                <form role='form' method='POST' action="{{ url('/admin/panel') }}">
                    {{ csrf_field() }}
                    <div class="form-group has-error">
                        <label for="inputEmail3" class="col-sm-2 control-label">Registration Gate</label>
                        <select name='registrationGate' class="form-control">
                            @foreach($option1 as $option)
                            @if($dataPanel->registrationGate == $option)
                            <option selected value='{{$option}}'>{{$option}}</option>
                            @else
                            <option value='{{$option}}'>{{$option}}</option>
                            @endif
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group has-error">
                        <label for="inputEmail3" class="col-sm-2 control-label">Try Out Gate</label>
                        <select name='tryOutGate' class="form-control">
                            @foreach($option2 as $option)
                            @if($dataPanel->tryOutGate == $option)
                            <option selected value='{{$option}}'>{{$option}}</option>
                            @else
                            <option value='{{$option}}'>{{$option}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group has-success">
                        <label for="inputEmail3" class="col-sm-2 control-label">Quiz Gate Kloter 1</label>
                        <select name='quizGate1' class="form-control">
                            @foreach($option3 as $option)
                            @if($dataPanel->quizGate1 == $option)
                            <option selected value='{{$option}}'>{{$option}}</option>
                            @else
                            <option value='{{$option}}'>{{$option}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group has-success">
                        <label for="inputEmail3" class="col-sm-2 control-label">Alert Quiz Batch 1</label>
                        <select name='alertQuiz1' class="form-control">
                            @foreach($option5 as $option)
                            @if($dataPanel->alertQuiz1 == $option)
                            <option selected value='{{$option}}'>{{$option}}</option>
                            @else
                            <option value='{{$option}}'>{{$option}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputEmail3" class="col-sm-2 control-label">Quiz Gate Kloter 2</label>
                        <select name='quizGate2' class="form-control">
                            @foreach($option4 as $option)
                            @if($dataPanel->quizGate2 == $option)
                            <option selected value='{{$option}}'>{{$option}}</option>
                            @else
                            <option value='{{$option}}'>{{$option}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputEmail3" class="col-sm-2 control-label">Alert Quiz Batch 2</label>
                        <select name='alertQuiz2' class="form-control">
                            @foreach($option6 as $option)
                            @if($dataPanel->alertQuiz2 == $option)
                            <option selected value='{{$option}}'>{{$option}}</option>
                            @else
                            <option value='{{$option}}'>{{$option}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Announcement</label>
                        <select name='announcementGate' class="form-control">
                            @foreach($option7 as $option)
                            @if($dataPanel->announcementGate == $option)
                            <option selected value='{{$option}}'>{{$option}}</option>
                            @else
                            <option value='{{$option}}'>{{$option}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-lg btn-info pull-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

