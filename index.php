<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doc to bin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>DOC file form</h2>
        <p class="lead">Below is an example form built for converting doc files.</p>
    </div>

    <div class="row" id="parsed">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Converted files</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Original file</h6>
                    </div>
                    <span class="text-muted" id="orig_name"></span>
                </li>
<!--                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Temporary b64 file</h6>
                    </div>
                    <span class="text-muted" id="tmp_b64"></span>
                </li>-->
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Binary file</h6>
                    </div>
                    <span class="text-muted" id="binary"></span>
                </li>
<!--                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Back converted b64 file</h6>
                    </div>
                    <span class="text-muted" id="back64"></span>
                </li>-->
<!--                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">New Word file</h6>
                    </div>
                    <span class="text-muted" id="final_doc"></span>
                </li>-->
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <p class="statusMsg"></p>
            <form enctype="multipart/form-data" id="fupForm" >
                <hr class="mb-4">
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" class="form-control" id="file" name="file" required />
                </div>
                <hr class="mb-4">
                <input type="submit" name="submit" class="btn btn-danger submitBtn" value="Submit"/>
            </form>
        </div>
    </div>

    <hr>
    <hr>


    <div class="py-5 text-center">
        <h2 style="color: #007bff">Binary data form</h2>
        <p class="lead">Below is an example form built for converting binary files.</p>
    </div>

    <div class="row" id="binary">

        <div class="col-md-8 order-md-1">
            <p class="statusMsg"></p>
            <form enctype="multipart/form-data" id="binaryform" >
                <hr class="mb-4">
                <div class="form-group">
                    <label for="file">Binary File</label>
                    <input type="file" class="form-control" id="file" name="binaryfile" required />
                </div>

                <select class="custom-select" id="ext" name="ext">
                    <option value="" selected>Please select original file extension</option>
                    <option value=".doc"> .doc </option>
                    <option value=".docx"> .docx </option>
                    <option value=".pdf"> .pdf </option>
                    <option value=".png"> .png </option>
                    <option value=".jpg"> .jpg </option>
                    <option value=".txt"> .txt </option>
                    <option value=".xls"> .xls </option>
                    <option value=".xlsx"> .xlsx </option>
                    <option value=".gif"> .gif </option>
                    <option value=".ppt"> .ppt </option>
                    <option value=".pptx"> .pptx </option>
                </select>

                <hr class="mb-4">
                <input type="submit" name="submit" class="btn btn-danger submitBtn" value="Submit"/>
            </form>
        </div>

        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Converted files</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Back file</h6>
                    </div>
                    <span class="text-muted" id="back_name"></span>
                </li>
            </ul>
        </div>

    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019</p>
    </footer>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="js/holder.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>


<script>
    $(document).ready(function(e){
        $("#fupForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'new_new_upload.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.submitBtn').attr("disabled","disabled");
                    $('#fupForm').css("opacity",".5");
                },
                success: function(data){
                    $('.statusMsg').html('');

                    var jsonData = JSON.parse(data);

                    $('#orig_name').empty();
                    $('#binary').empty();
                    $('#final_doc').empty();
                    $('#tmp_b64').empty();
                    $('#back64').empty();

                    $('#orig_name').append("<a href='"+jsonData.input_file+"' target=\"_blank\">"+jsonData.only_name+"</a>");
                    $('#binary').append("<a href='"+jsonData.binary+"' target=\"_blank\">Binary file</a>");
                    //$('#final_doc').append("<a href='"+jsonData.final_doc+"' target=\"_blank\">New DOC file</a>");
                    //$('#tmp_b64').append("<a href='"+jsonData.tmp_b64+"' target=\"_blank\">Temporary base64 file</a>");
                    //$('#back64').append("<a href='"+jsonData.back_b64+"' target=\"_blank\">Final base64 file</a>");

                    $('#fupForm').css("opacity","");
                    $(".submitBtn").removeAttr("disabled");
                }
            });
        });
    });
</script>






<script>
    $(document).ready(function(e){
        $("#binaryform").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'binary_upload.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.submitBtn').attr("disabled","disabled");
                    $('#binaryform').css("opacity",".5");
                },
                success: function(data){
                    $('.statusMsg').html('');

                    var jsonData = JSON.parse(data);

                    $('#back_name').empty();

                    $('#back_name').append("<a href='"+jsonData.final_doc+"' target=\"_blank\">Back-converted file</a>");

                    $('#binaryform').css("opacity","");
                    $(".submitBtn").removeAttr("disabled");
                }
            });
        });
    });
</script>


</body>
</html>