@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Suggestion</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class='col-md-12' style='background-color: white'>
        <div class='row'>
            <div class="table-responsive" data-example-id="striped-table">
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>Username</th>
                            <th>Suggestion</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($memberSuggestion as $index => $memberSuggestion)
                        <tr>

                            <td>{{$memberSuggestion->username}}</td>
                            <td>{{$memberSuggestion->suggestion}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

