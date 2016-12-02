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
    <div class='col-md-12' style='background-color: white'>
        <!--Content-->
        @if(empty($quiz))
        <form role="form" method="post" enctype="multipart/form-data" action="{{ url('/admin/Trial/quiz/add') }}"  >
            @else
            <form role="form" method="post" enctype="multipart/form-data" action="{{url("/admin/Trial/quiz/edit/$quiz->id")}}"  >
                @endif
                {{ csrf_field() }}
                @foreach($question as $index => $question)
                @if($question == 'answer')
                <label>{{$question}}</label>
                <select name='{{$question}}' class="form-control">
                    <!--Looping the choices selec option-->
                    @foreach($choices as $choices)
                    @if(!empty($quiz)&&($quiz->$question == $choices))
                    <option selected>{{$choices}}</option>
                    @else
                    <option>{{$choices}}</option>
                    @endif
                    @endforeach
                </select>
                @else
                <div class="form-group controls has-success">
                    <label>{{$choices_1[$index]}}</label>
                    <textarea id="textarea" name="{{$question}}" class="form-control" rows="3">@if(!empty($quiz)) {{$quiz->$question}} @endif</textarea>
                    <p class="help-block text-danger"></p>
                </div>
                @endif
                @endforeach
                <br>
                <div class='form-group'>
                    <div class='col-md-12'>
                        <input type='submit' class='btn pull-right btn-info' name='submit' value='submit'>
                    </div>
                </div>
            </form>
    </div>
</div>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
// ===========================================
// INCLUDE THE PLUGIN
// ===========================================
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste jbimages"
        ],
// ===========================================
// PUT PLUGIN'S BUTTON on the toolbar
// ===========================================
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
// ===========================================
// SET RELATIVE_URLS to FALSE (This is required for images to display properly)
// ===========================================
        relative_urls: false
    });

</script>


@endsection

