
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="{{asset('css/freelancer.css?v=4')}}" rel="stylesheet">
    </head>
    <body style="font-family:Roboto;background-color: rgb(237, 237, 237);padding-top:0px">
        <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
        <script type="text/javascript">

tinymce.init({
    selector: "textarea",
    plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste responsivefilemanager"],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager",
    image_advtab: true,
    relative_urls: false,
    external_filemanager_path: "{!! str_finish(asset('/filemanager'),'/') !!}",
    filemanager_title: "Responsive File Manager", // bisa diganti terserah anda
    external_plugins: {"filemanager": "{{ asset('/filemanager/plugin.min.js') }}"}
});
        </script>
        <!-- /TinyMCE -->
        <!-- /TinyMCE -->

        <form>
            <div class="container" style="background-color: white;"  >
                <form action=”ci/index.php?/upload/{#jbimages_dlg.lang_id}”>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Judul</label>	
                                <input type="text" class="form-control" name="judul" id="exampleInputEmail1"  placeholder="Judul" required />
                            </div>

                        </div>
                    </div>

                    <br>

                    <label>Isi Artikel</label>
                    <textarea type="text"  rows="9" name="isi_artikel" class="form-control" placeholder="Text input"> 
                    </textarea>

                    <br>
                    <button type="submit" value="submit" class="btn btn-primary btn-lg pull-right">Submit</button>

            </div>
        </form>
    </body>



</html>