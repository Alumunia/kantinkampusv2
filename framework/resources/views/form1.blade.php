<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.css" rel="stylesheet">
    </head>
    <body>


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
                    <textarea id="message" type="text"  rows="9" name="isi_artikel" class="form-control" placeholder="Text input"> 
                    </textarea>

                    <br>
                    <button type="submit" value="submit" class="btn btn-primary btn-lg pull-right">Submit</button>

            </div>
        </form>

        <!-- Load all JS at footer for faster website loading.. -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.0/summernote.js"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery('#message').summernote({
                    height: 250,
                    callbacks: {
                        onImageUpload: function (files, editor, $editable) {
                            alert('evoked');
                            sendFile(files[0], editor, $editable);
                        }
                    }
                });
                function sendFile(file, editor, welEditable) {
                    data = new FormData();
                    data.append("file", file);
                    jQuery.ajax({
                        url: "{{ URL::to('upload/image') }}",
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function (s) {
                            jQuery('#message').summernote("insertImage", s);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus + " " + errorThrown);
                        }
                    });
                }
            });
        </script>
    </body>
</html>