@extends('layouts.layout')

@section('content')
<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Jual barang</h4>
            </div>
            <div class="modal-body">
                <!--Form Add Product -->
                <form action='/auth' class='dropzone' enctype='multipart/form-data' id='image-upload'>
                    <div class="form-group">
                        <label for="exampleInputEmail1" >Nama Barang</label>
                        <input type="text" class="form-control" name="productName" id="exampleInputEmail1" placeholder="Nama Barang">
                    </div>

                    <div class="form-group">
                        <label>Harga barang</label>
                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            <input type="number" class="form-control" id="exampleInputAmount" placeholder="Harga Barang">
                            <div class="input-group-addon">.00</div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="exampleInputFile" >Deskripsi barang</label>
                        <textarea class="form-control" name="productDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile" >Foto barang</label>
                    </div>

                </form>
                <!--./Form Add Product-->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Submit</button>   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        @if(Session::has('status'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
        @endif
        <div class="col-lg-12 text-center">
            <h2>welcome {{$dataMember->username}}</h2>
            <hr class="star-primary">
            <div class="jumbotron" style="height:500px">
                <div class="col-md-12">
                    <img src="{{asset('framework/images/photoprofile.jpg')}}" alt="..." height="250px" class="img-circle">
                    <h2>Rizki Adi Utomo</h2>
                    <p>Institut Pertanian Bogor</p>
                    <a class="btn btn-primary btn-md" href="#" role="button"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> edit</a>
                </div>
            </div>
            @if($dataPanel->announcementGate == 'hidden')
            @if($statusPendaftaran == 0)
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> Pendaftaran belum selesai, harap segera selesaikan pendaftaran <a href="{{ url('/profile/'.Auth::guard('member')->user()->username) }}/edit" class="alert-link">selesaikan pendaftaran</a>
            </div>
            @else
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Well Done!</strong> Proses pendaftan kamu sudah selesai.
            </div>
            @endif
            @if(($dataMember->statusTim)==0)
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Akun tim belum terverifikasi oleh panitia !</strong> Segera submit dan tunggu panitia melakukan verifikasi
            </div>
            @else
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Akun sudah terverifikasi</strong>
            </div>
            @endif
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addProduct"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Jual Barang</button>
            </div>
            <div class="col-md-12">
                <div class="row">
                    @for($i=0;$i<4;$i++)
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 align='center' class="panel-title">{{$dataMember->$dataExistTim[$number[$i]]}}</h3>
                            </div>
                            <div class="panel-body">
                                @if(!empty($dataMember->$dataExistTim[$number[$i]+4]))
                                <img style='margin-left: 40px;margin-bottom: 10px' src="{{asset('framework/images/'.$dataMember->$dataExistTim[$number[$i]+4])}}" width="130px" height="130px" class="img-circle">
                                @else
                                <p>no photo here</p>
                                @endif
                                <ul class="list-group">
                                    <li class="list-group-item">posisi :  {{$posisi[$i]}}</li>
                                    <li class="list-group-item">No Hp  :  {{($dataMember->$dataExistTim[$number[$i]+2])}}</li>
                                    <li class="list-group-item">Email  :  {{($dataMember->$dataExistTim[$number[$i]+3])}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
        <form role='form' method='POST' action="{{ url('/member/suggestion') }}">
            <label>Kritik dan saran untuk panitia</label>
            <div class="form-group has-warning">
                <textarea id="textarea"   name='suggestion' class="form-control"  rows="3">Silahkan diisi jika kamu punya saran untuk LCTIP yang lebih baik :)</textarea>
                {{ csrf_field() }}
                <br>
            </div>
            <input type='submit' class='btn pull-right btn-info' name='submit' value='submit'>
        </form>

        <!--        <h4 align='center'>On The Way To Competition</h4>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%">
                        <span class="sr-only">{{$progress}}% Complete</span>
                    </div>
                </div>-->
    </div><!--/Col-md-12-->
    <div class='col-md-12 text-center'>
        <p>LCTIP2016-Copyright</p>
    </div>
</div>

<!-- script dropzone -->
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
</script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
@endsection