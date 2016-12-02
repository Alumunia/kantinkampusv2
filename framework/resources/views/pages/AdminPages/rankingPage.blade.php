@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Ranking</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class='col-md-12' style='background-color: white'>
        <div class='row'>
            <div class='col-md-12'>
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Regional</th>
                            <th>Nama Sekolah</th>
                            <th>Nama Tim</th>

                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataPeserta as $index => $dataPeserta)
                        <tr>
                            <th>{{$index+1}}</th>
                            <td>{{$dataPeserta->username}}</td>
                            <td>{{$dataPeserta->regional}}</td>
                            <td>{{$dataPeserta->namaSekolah}}</td>
                            <td>{{$dataPeserta->namaTim}}</td>

                            <td>{{$dataPeserta->score}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

