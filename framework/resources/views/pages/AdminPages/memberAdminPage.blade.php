@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus?

                <div class="form-group">
                    <label for="recipient-name" class="control-label">Recipient:</label>
                    <input type="text" class="form-control" id="recipient-name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class='btn btn-info pull-right' form="member_delete" type="submit" name="submit" value="yes">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal90" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/reset-password') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Username</label>
                        <select name='username' class="form-control">

                            @foreach($dataMember as $dataMember_username)
                            <option>{{$dataMember_username->username}}</option>
                            @endforeach 
                        </select> </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 text-center">
        <h2>Members</h2>
        <hr class="star-primary">
    </div>
</div>
<!-- Button trigger modal -->

<div class='col-md-12' style='background-color: white'>
    <div class='row'>
        <div class='col-md-6'>
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal90">
                Reset Password
            </button>
        </div>
        <div class='col-md-6'>
            <h5 class='pull-right'>Jumlah Peserta : {{$dataMember_count}}</h5>
        </div>
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Data peserta
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <!--Content-->
                    <div class="table-responsive" data-example-id="striped-table">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email Sekolah</th>
                                    <th>Status Pendaftaran</th>
                                    <th>Status Tim</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($dataMember as $index => $dataMember)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$dataMember->username}}</td>
                                    <td>{{$dataMember->emailSekolah}}</td>
                                    @if ($dataMember->statusPendaftaran == 0)
                                    <td>uncomplete</td>
                                    @else
                                    <td>complete</td>
                                    @endif
                                    @if ($dataMember->statusTim == 1)
                                    <td>verified</td>
                                    @else
                                    <td>not verified</td>
                                    @endif
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="{{ url("/resetQuizChance/$dataMember->username") }}" role="button">Reset quiz chance</a> ||
                                        <a class="btn btn-sm btn-info" href="{{ url("/admin/member/$dataMember->username") }}" role="button">Detail </a> ||
                                        @if($dataMember->statusTim == 1)
                                        <a class="btn btn-sm btn-danger" href="{{ url("/activateMember/$dataMember->username/0") }}" role="button">disable</a> 
                                        @else
                                        <a class="btn btn-sm btn-success" href="{{ url("/activateMember/$dataMember->username/1") }}" role="button">activate</a> 
                                        @endif
                                        ||  
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <form id="member_delete" method="POST" action="{{ url('/admin/member/delete') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name='username' value='{{$dataMember->username}}'>
                                                    <li> <p align="center">are u sure?  <input class='btn btn-sm btn-info'  type="submit" name="submit" value="yes"><p></li>
                                                </form> 

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div><!-- /example -->


                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Pemenang tahap 2
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="table-responsive" data-example-id="striped-table">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email Sekolah</th>
                                    <th>Status Pendaftaran</th>
                                    <th>Status Tim</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($winnerMember as $index => $winnerMember)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$winnerMember->username}}</td>
                                    <td>{{$winnerMember->emailSekolah}}</td>
                                    @if ($winnerMember->statusPendaftaran == 0)
                                    <td>uncomplete</td>
                                    @else
                                    <td>complete</td>
                                    @endif
                                    @if ($winnerMember->statusTim == 1)
                                    <td>verified</td>
                                    @else
                                    <td>not verified</td>
                                    @endif
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="{{ url("/resetQuizChance/$winnerMember->username") }}" role="button">Reset quiz chance</a> ||
                                        <a class="btn btn-sm btn-info" href="{{ url("/admin/member/$winnerMember->username") }}" role="button">Detail </a> ||
                                        @if($winnerMember->statusTim == 1)
                                        <a class="btn btn-sm btn-danger" href="{{ url("/activateMember/$winnerMember->username/0") }}" role="button">disable</a> 
                                        @else
                                        <a class="btn btn-sm btn-success" href="{{ url("/activateMember/$winnerMember->username/1") }}" role="button">activate</a> 
                                        @endif
                                        ||  
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <form id="member_delete" method="POST" action="{{ url('/admin/member/delete') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name='username' value='{{$winnerMember->username}}'>
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
            </div>
        </div>

    </div>


</div>


@endsection

