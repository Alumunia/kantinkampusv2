@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif
<style>
    .table {
        border-radius: 5px;
        width: 50%;
        margin: auto;
        float: none;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>{{$choices->username}}</h2>
            <hr class="star-primary">
        </div>
    </div>
    <div class='col-md-12'>
        <div class='row'>
            <div class='col-md-4' style='background-color: white'>
                <div class='row'>
                    <div class='col-md-12 text-center'>
                        <h4>Isi jawaban</h4>
                        <table class="table text-center  table-striped table-responsive" >
                            <thead>
                                <tr>
                                    <th >Key</th>
                                    <th >Value</th>
                                    <th >Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $j = 2; ?>
                                @for ($i = 0; $i <= 99; $i++)
                                <tr>

                                    <th scope="row">{{$columns[$j]}}</th>
                                    @if(($choices->$columns[$j] == 'NU') || (empty($choices->$columns[$j]))) 
                                    <td class="warning">{{$choices->$columns[$j]}}</td>
                                    @elseif(($choices->$columns[$j]) == $answer[$i]) 
                                    <td class="info">{{$choices->$columns[$j]}}</td>
                                    @elseif (($choices->$columns[$j]) != $answer[$i]) 
                                    <td class="danger">{{$choices->$columns[$j]}}</td>
                                    @endif
                                    <td>{{$answer[$i]}}</td>
                                    <?php $j++; ?>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4 class="text-center">Perhitungan</h4>
                <table class="table  table-striped table-responsive" >
                    <thead>
                        <tr>
                            <th >Key</th>
                            <th >Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class='info'>Jumlah jawaban benar</td>
                            <td>{{$jumlahBenar}}</td>
                        </tr>
                        <tr>
                            <td class='danger'>Jumlah jawaban salah</td>
                            <td>{{$jumlahSalah}}</td>
                        </tr>
                        <tr>
                            <td class='warning'>Jumlah jawaban kosong</td>
                            <td>{{$jumlahKosong}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h4>Score</h4>
                @if(empty($choices->score))
                <a type='button' class="btn btn-lg btn-primary" href="{{ url("/admin/result/score/$choices->username") }}" role="button">Score This!</a>
                @else
                <h1>{{$choices->score}}</h1>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection

