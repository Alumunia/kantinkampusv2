@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>welcome {{$dataMember->username}}</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class='col-md-12' style='background-color: white'>
        <div class='row'>
            <div class='col-md-12'>
                <br>
                <br>
                <form role='form' method='POST' action="{{ url('/profile/'.Auth::guard('member')->user()->username.'/panel') }}">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <div class="well well-lg">
                            {!! $dataAdmin->rules !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if($dataPanel->tryOutGate == 'open')
                                        <button type="submit" class="btn btn-lg btn-warning" name="status" value='goToTryout' >Go To Tryout!</button>
                                        @else
                                        <button type="submit" class="btn btn-lg btn-warning" disabled="disabled" name="status" value='goToTryout'>Go To Tryout!</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if($dataPanel->alertQuiz1 == 'show')
                                        @if(((Auth::guard('member')->user()->regional) ==1) ||((Auth::guard('member')->user()->regional) ==2)||((Auth::guard('member')->user()->regional) ==3)||(Auth::guard('member')->user()->regional) ==4)
                                        <button type="submit" class="btn btn-lg btn-success " name="status" value='goToQuiz1'>Go To Online Test (Region I-IV)!</button>
                                        @else
                                        <button type="submit" class="btn btn-lg btn-success" disabled="disabled" name="status" value='goToQuiz1' >Go To Online Test (Region I-IV)!</button>
                                        @endif
                                        @else
                                        <button type="submit" class="btn btn-lg btn-success" disabled="disabled" name="status" value='goToQuiz1' >Go To Online Test (Region I-IV)!</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if($dataPanel->alertQuiz2 == 'show')
                                        @if(((Auth::guard('member')->user()->regional) ==5) ||((Auth::guard('member')->user()->regional) ==6)||((Auth::guard('member')->user()->regional) ==7)||(Auth::guard('member')->user()->regional) ==8)
                                        <button type="submit" class="btn btn-lg btn-success " name="status" value='goToQuiz2'>Go To Online Test (Region V-VIII)!</button>
                                        @else
                                        <button type="submit" class="btn btn-lg btn-success" disabled="disabled" name="status" value='goToQuiz2' >Go To Online Test (Region V-VIII)!</button>
                                        @endif
                                        @else
                                        <button type="submit" class="btn btn-lg btn-success" disabled="disabled" name="status" value='goToQuiz2' >Go To Online Test (Region V-VIII)!</button>
                                        @endif
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection