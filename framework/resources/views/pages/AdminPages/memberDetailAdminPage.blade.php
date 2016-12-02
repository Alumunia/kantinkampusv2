@extends('layouts.AdminLayouts.layout')

@section('content')
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                Pastikan semua data sudah terisi, karena data yang sudah disubmit tidak akan bisa dirubah lagi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class='btn btn-info pull-right' form="member_registration" type="submit" name="submit" value="submit">
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Petunjuk</h4>
            </div>
            <div class="modal-body">
                Kalian bisa melakukan registrasi tanpa harus mengisi semua field, kalian bisa melanjutkan pengisian field dengan melakukan login sebagai peserta
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>{{$dataMember->username}}</h2>
            <hr class="star-primary">
        </div>

    </div>

    <div class="col-md-12" style="background-color:white">

        <script>
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').focus()
            })
        </script>
        <form role="form" method="post" enctype="multipart/form-data" id='member_registration' action="{{ url('register') }}" >
            <div class="col-md-6">

                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data TIM</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($fieldRegistration_dataTim as $index => $fieldRegistration_dataTim)
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label for="{{$fieldRegistration_dataTim->parameter_name}}">{{$fieldRegistration_dataTim->question}}</label>
                                    @if(!isset($dataMember))
                                    @if(($fieldRegistration_dataTim->type_question) == 'select')
                                    <select name="{{$fieldRegistration_dataTim->parameter_name}}" class="form-control">
                                        @for($i=1;$i<9;$i++)
                                        <option value='{{$i}}' >Regional {{$i}}</option>
                                        @endfor
                                    </select>
                                    @else
                                    <input id="{{$fieldRegistration_dataTim->parameter_name}}"  type="{{$fieldRegistration_dataTim->type_question}}" class="form-control" required placeholder="{{$fieldRegistration_dataTim->question}}" name="{{$fieldRegistration_dataTim->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataTim->question}}" required value="{{ old($fieldRegistration_dataTim->parameter_name) }}"/>
                                    @endif <!--/ end check for select use -->
                                    @else
                                    @if((isset($dataMember))&&($fieldRegistration_dataTim->parameter_name == 'username'))
                                    <input class="form-control" type="text" value="{{$dataMember->$dataExistTim[0]}}">
                                    <input type='hidden' name='username' value='{{$dataMember->$dataExistTim[$index]}}'>
                                    @elseif((isset($dataMember))&&($fieldRegistration_dataTim->parameter_name == 'password'))
                                    @else
                                    @if(($fieldRegistration_dataTim->type_question) == 'select')
                                    <select name="{{$fieldRegistration_dataTim->parameter_name}}" class="form-control">
                                        @for($i=1;$i<9;$i++)
                                        @if($dataMember->$dataExistTim[$index] == $i )
                                        <option selected value='{{$i}}' >Regional {{$i}}</option >
                                        @else
                                        <option value='{{$i}}' >Regional {{$i}}</option>
                                        @endif <!--check selected -->
                                        @endfor
                                    </select>
                                    @else
                                    <input id="{{$fieldRegistration_dataTim->parameter_name}}"  type="{{$fieldRegistration_dataTim->type_question}}" class="form-control" required placeholder="{{$fieldRegistration_dataTim->question}}" name="{{$fieldRegistration_dataTim->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataTim->question}}" required value="{{$dataMember->$dataExistTim[$index]}}"/>
                                    @endif <!-- check select question -->
                                    @endif
                                    @endif
                                    @if ($errors->has($fieldRegistration_dataTim->parameter_name))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first($fieldRegistration_dataTim->parameter_name) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div><!--/MD-COL-6-->
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Pebimbing</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($fieldRegistration_dataPebimbing as $index => $fieldRegistration_dataPebimbing)
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">

                                    @if($fieldRegistration_dataPebimbing->type_question == 'file')
                                    @endif
                                    <label>{{$fieldRegistration_dataPebimbing->question}}</label>
                                    @if(!isset($dataMember))
                                    <input id="{{$fieldRegistration_dataPebimbing->parameter_name}}"  type="{{$fieldRegistration_dataPebimbing->type_question}}" class="form-control"  placeholder="{{$fieldRegistration_dataPebimbing->question}}" name="{{$fieldRegistration_dataPebimbing->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataPebimbing->question}}"  value="{{ old($fieldRegistration_dataPebimbing->parameter_name) }}"/>
                                    @else
                                    @if((($fieldRegistration_dataPebimbing->type_question) == 'file')&& (!empty($dataMember->$dataExistTim[$index+25])))
                                    <a type='button' class='btn btn-sm btn-success' href="getDownload/{{$dataMember->username}}/{{($dataMember->$dataExistTim[$index+25])}}">
                                        <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download exist file {{($dataMember->$dataExistTim[$index+25])}}
                                    </a>
                                    @endif
                                    <input id="{{$fieldRegistration_dataPebimbing->parameter_name}}"  type="{{$fieldRegistration_dataPebimbing->type_question}}" class="form-control" placeholder="{{$fieldRegistration_dataPebimbing->question}}" name="{{$fieldRegistration_dataPebimbing->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataPebimbing->question}}"  value="{{$dataMember->$dataExistTim[$index+25]}}"/>
                                    @endif
                                    <p class="help-block text-danger"></p>
                                    @if ($errors->has($fieldRegistration_dataPebimbing->parameter_name))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first($fieldRegistration_dataPebimbing->parameter_name) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                </div>


            </div><!--/MD-COL-6-->
            <div class="col-md-12">
                <div class="row">
                    <!--Start Of Looping-->
                    @foreach($dataAnggotaArray as $index => $dataAnggotaArray)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$arrayCaption[$index]}} </h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">

                                    @foreach($dataAnggotaArray as $index1 => $dataAnggotaArray)
                                    <div class="row control-group">
                                        <div class="form-group col-xs-12 floating-label-form-group controls">
                                            @if($dataAnggotaArray->type_question == 'file')

                                            @endif
                                            <label>{{$dataAnggotaArray->question}}</label>
                                            @if(!isset($dataMember))
                                            <input id="{{$dataAnggotaArray->parameter_name}}"  type="{{$dataAnggotaArray->type_question}}" class="form-control"  placeholder="{{$dataAnggotaArray->question}}" name="{{$dataAnggotaArray->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$dataAnggotaArray->question}}" value="{{ old($dataAnggotaArray->parameter_name) }}"/>
                                            @else
                                            @if((($dataAnggotaArray->type_question) == 'file')&& (!empty($dataMember->$dataExistTim[$number[$index]+$index1])))
                                            <a type='button' class='btn btn-sm btn-success' href="getDownload/{{$dataMember->username}}/{{$dataMember->$dataExistTim[$number[$index]+$index1]}}">
                                                <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download exist file {{$dataMember->$dataExistTim[$number[$index]+$index1]}}
                                            </a>
                                            @endif
                                            <input id="{{$dataAnggotaArray->parameter_name}}"  type="{{$dataAnggotaArray->type_question}}" class="form-control"  placeholder="{{$dataAnggotaArray->question}}" name="{{$dataAnggotaArray->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$dataAnggotaArray->question}}" value="{{$dataMember->$dataExistTim[$number[$index]+$index1]}}"/>
                                            @endif
                                            <p class="help-block text-danger"></p>
                                            @if ($errors->has($dataAnggotaArray->parameter_name))
                                            <span class="help-block">
                                                <strong style="color:red">{{ $errors->first($dataAnggotaArray->parameter_name) }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--/End Of Looping-->

                    @if(isset($dataMember))
                    <input type='hidden' name='status' value='update'>
                    @else
                    <input type='hidden' name='status' value='notUpdate'>
                    @endif

                </div><!--/row-->
            </div><!--/div-col-md-12-->
            <div class='col-md-12'>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Data Lainya</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($fieldRegistration_dataLain as $index => $fieldRegistration_dataLain)
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    @if(($fieldRegistration_dataLain->type_question == 'file') || ($fieldRegistration_dataLain->type_question == 'boolean'))
                                    <label>{{$fieldRegistration_dataLain->question}}</label>
                                    @endif
                                    @if(isset($dataMember))
                                    @if($fieldRegistration_dataLain->question == 'Kolom Persetujuan')
                                    <h4> <input type="checkbox" checked name='{{$fieldRegistration_dataLain->parameter_name}}' value="1" required> Pendaftar menyatakan bahwa data yang diisi adalah benar dan menyetujui bahwa informasi tersebut akan menjadi hak dan kewenangan panitia </h4>
                                    @elseif((($fieldRegistration_dataLain->type_question) == 'file')&& (!empty($dataMember->$dataExistTim[$index+31])))
                                    <a type='button' class='btn btn-sm btn-success' href="getDownload/{{$dataMember->username}}/{{($dataMember->$dataExistTim[$index+31])}}">
                                        <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download exist file {{($dataMember->$dataExistTim[$index+31])}}
                                    </a>
                                    <input id="{{$fieldRegistration_dataLain->parameter_name}}"  type="{{$fieldRegistration_dataLain->type_question}}" class="form-control"  placeholder="{{$fieldRegistration_dataLain->question}}" name="{{$fieldRegistration_dataLain->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataLain->question}}" value="{{ old($fieldRegistration_dataLain->parameter_name) }}"/>

                                    @else
                                    <input id="{{$fieldRegistration_dataLain->parameter_name}}"  type="{{$fieldRegistration_dataLain->type_question}}" class="form-control"  placeholder="{{$fieldRegistration_dataLain->question}}" name="{{$fieldRegistration_dataLain->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataLain->question}}" value="{{ old($fieldRegistration_dataLain->parameter_name) }}"/>
                                    @endif<!---Check file-->
                                    @else<!--check if !isset dataMember-->
                                    @if($fieldRegistration_dataLain->question == 'Kolom Persetujuan')
                                    <h4> <input type="checkbox" name='{{$fieldRegistration_dataLain->parameter_name}}' value="1" required> Pendaftar menyatakan bahwa data yang diisi adalah benar dan menyetujui bahwa informasi tersebut akan menjadi hak dan kewenangan panitia </h4>
                                    @else
                                    <input id="{{$fieldRegistration_dataLain->parameter_name}}"  type="{{$fieldRegistration_dataLain->type_question}}" class="form-control"  placeholder="{{$fieldRegistration_dataLain->question}}" name="{{$fieldRegistration_dataLain->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataLain->question}}" value="{{ old($fieldRegistration_dataLain->parameter_name) }}"/>
                                    @endif
                                    @endif
                                    <p class="help-block text-danger"></p>
                                    @if ($errors->has($fieldRegistration_dataLain->parameter_name))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first($fieldRegistration_dataLain->parameter_name) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class='col-md-12'>
                @foreach($fieldRegistration_dataLainTahap2 as $fieldRegistration_dataLainTahap2)
                <div class="panel-heading text-center">
                    <h2>Data Tahap 2</h2>
                    <hr class="star-primary">
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$fieldRegistration_dataLainTahap2->question}}</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>{{$fieldRegistration_dataLainTahap2->question}}</label>

                                    @if(!empty($dataMember->$dataExistTim[33]))
                                    <a type='button' class='btn btn-sm btn-success' href="getDownload/{{$dataMember->username}}/{{($dataMember->$dataExistTim[33])}}">
                                        <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Download exist file {{($dataMember->$dataExistTim[33])}}
                                    </a>
                                    <input id="{{$fieldRegistration_dataLainTahap2->parameter_name}}"  type="{{$fieldRegistration_dataLainTahap2->type_question}}" class="form-control"  placeholder="{{$fieldRegistration_dataLainTahap2->question}}" name="{{$fieldRegistration_dataLainTahap2->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataLainTahap2->question}}" value="{{ old($fieldRegistration_dataLainTahap2->parameter_name) }}"/>
                                    @else
                                    <span class="help-block">
                                        <strong style="color:red">The file is still empty</strong>
                                    </span>
                                    <input id="{{$fieldRegistration_dataLainTahap2->parameter_name}}"  type="{{$fieldRegistration_dataLainTahap2->type_question}}" class="form-control"  placeholder="{{$fieldRegistration_dataLainTahap2->question}}" name="{{$fieldRegistration_dataLainTahap2->parameter_name}}"  data-validation-required-message="silahkan masukkan {{$fieldRegistration_dataLainTahap2->question}}" value="{{ old($fieldRegistration_dataLainTahap2->parameter_name) }}"/>
                                    @endif

                                    <!---Check file-->
                                    <p class="help-block text-danger"></p>
                                    @if ($errors->has($fieldRegistration_dataLainTahap2->parameter_name))
                                    <span class="help-block">
                                        <strong style="color:red">{{ $errors->first($fieldRegistration_dataLainTahap2->parameter_name) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="form-group col-md-12">
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <input type='hidden' name='admin' value='1'>
                        <input class='btn btn-success btn-lg pull-left' type="submit" name="submit" value="save">
                        <!--<button  type="submit" value="save" class="btn btn-success btn-lg pull-left">Save</button>-->
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>

@endsection