@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>quiz TryOut</h2>
            <hr class="star-primary">
        </div>
    </div>
    <style>
        #text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            line-height: 17px;     /* fallback */
            max-height: 52px;      /* fallback */
            -webkit-line-clamp: 3; /* number of lines to show */
            -webkit-box-orient: vertical;
            word-wrap: break-word;
            width: 100px;
        }
    </style>
    <div class='col-md-12' style='background-color: white'>
        <a class="btn btn-warning" href='{{url("/admin/Trial/quiz/add")}}' role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add quiz</a>
        <a class="btn btn-info pull-right" href='{{url("/admin/Trial/quiz/review")}}' role="button"><span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Review quiz</a>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div><!--Content-->
        <h5 class="modal-title" id="myModalLabel">Jumlah Soal : {{$jumlahSoal}}</h5>
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Question</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th class="success">Answer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quiz as $index => $quiz)
                <tr>
                    <th scope="row">{{$index + 1}}</th>
                    <td><div id='text'>{!! $quiz->question !!}</div></td>
                    <td><div id='text'>{!!$quiz->choices1!!}</div></td>
                    <td><div id='text'>{!!$quiz->choices2!!}</div></td>
                    <td><div id='text'>{!!$quiz->choices3!!}</div></td>
                    <td><div id='text'>{!!$quiz->choices4!!}</div></td>
                    <td><div id='text'>{!!$quiz->choices5!!}</div></td>
                    <td class="success"><strong><div id='text'>{!! $quiz->answer !!}</div></strong></td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{url("/admin/Trial/quiz/edit/$quiz->id")}}" role="button">Edit</a> ||
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <form id="member_delete" method="POST" action="{{ url('/admin/Trial/quiz/delete') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name='id' value='{{$quiz->id}}'>
                                    <li> <p align="center">are u sure?  <input class='btn btn-sm btn-info'  type="submit" name="submit" value="yes"><p></li>
                                </form> 
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

