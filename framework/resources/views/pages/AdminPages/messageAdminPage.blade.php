@extends('layouts.AdminLayouts.layout')
@section('content')
<!-- Modal -->
@if(Session::has('status'))
<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('status') !!}</em></div>
@endif
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Message</h2>
            <hr class="star-primary">
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
    <div class='col-md-12' style='background-color: white'>
        <!--Content-->

        <form role='form' method='POST' action="{{ url('/admin/message') }}">
            <label>Message</label>
            <textarea id="textarea"   name='message' class="form-control"  rows="3">{!! $dataAdmin->message !!}</textarea>
            <input type="hidden" name='username' value='dsfsdf'>
            {{ csrf_field() }}
            <br>
            <input type='submit' class='btn pull-right btn-info' name='submit' value='submit'>
        </form>
        <br>
        <form role='form' method='POST' action="{{ url('/admin/rules') }}">
            <label>Rules</label>
            <textarea id="textarea"    name='rules' class="form-control"  rows="3">{!! $dataAdmin->rules !!}</textarea>
            <input type="hidden" name='username' value='dsfsdf'>
            {{ csrf_field() }}
            <br>
            <input type='submit' class='btn pull-right btn-info' name='submit' value='submit'>
        </form>

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Preview</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="col-md-12">
            <label>Message</label>
            <div class="well well-lg">
                <p>
                    {!! $dataAdmin->message !!}
                </p>                    
            </div>
        </div>
        <div class="col-md-12">
            <label>Rules</label>
            <div class="well well-lg">
                <p>
                    {!! $dataAdmin->rules !!}
                </p>                    
            </div>
        </div>
    </div>
</div>


@endsection

