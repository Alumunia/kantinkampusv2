@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Online Test Result</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class='col-md-12' style='background-color: white'>
        <div class='row'>
            <div class='col-md-12'>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Regional</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Check the answer</th>
                            <th>Action</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($choices as $index => $choices)
                        @if($choices->statusTryOut ==  1)
                        @if(($choices->regional ==  1)||($choices->regional ==  2)||($choices->regional ==  3)||($choices->regional ==  4))
                        <tr class="success">
                            @else
                        <tr class="warning">
                            @endif
                            @endif
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$choices->username}}</td>
                            <td>{{$choices->regional}}</td>
                            <td>{{date('d F Y -- H:i:s', $choices->timeStartTryOut)}}</td>
                            @if($choices->statusTryOut ==  1)
                            <td>{{date('d F Y -- H:i:s', $choices->currentTimeTryOut)}}</td>
                            @else
                            <td>Masih mengerjakan</td>
                            @endif
                            <td><a class="btn btn-sm btn-info" href="{{ url("/admin/result/checkAnswer/$choices->username") }}" role="button">Check the answer</a> </td>
                            <td><a class="btn btn-sm btn-primary" href="{{ url("/admin/result/score/$choices->username") }}" role="button">Score This!</a> </td>
                            <td><strong>{{$choices->score}}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

