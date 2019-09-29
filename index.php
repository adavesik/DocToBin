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
    <link href="css/custom.css" rel="stylesheet">
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

    <hr>
    <hr>


    <div class="py-5 text-center">
        <h2 style="color: #007bff">User Key </h2>
        <p class="lead">Below is an example form built for converting binary files.</p>
    </div>
    <div class="row" id="binary">
        <div class="col-md-8 order-md-1">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="User Key" aria-label="User Key" id="key" aria-describedby="basic-addon2" maxlength="1666667">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" name="userkey" id="userkey" type="button">Convert To SixBit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="binary">
        <div class="col-md-8 order-md-1">
            <blockquote class="mint" id="userkeybinary">
                <h5>User Key converted to <span class="Cmint">SixBit</span> binary form:</h5>
                <span id="binarykey"></span>
            </blockquote>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <div class="input-group mb-3">
                <div class="">
                    <button class="btn btn-info" name="expand" id="expand" type="button">Expand to 2^26 and Download</button>
                </div>
            </div>
            <span id="expandedfile"></span>
        </div>
    </div>

    <div class="row" id="split-files">
        <div class="col-md-8 order-md-1">
            <blockquote class="mint">
                <h5>Bellow you can download <span class="Cmint">8</span> files:</h5>
                <span id="split-files"></span>
            </blockquote>
        </div>
    </div>

    <hr>


    <div class="py-5 text-center">
        <h2 style="color: #007bff">Universal Random Sequence </h2>
        <p class="lead">Below is a button for generating URS.</p>
    </div>
    <div class="row">
        <div class="col-md-8 order-md-1">
            <blockquote class="lavander" >
                <h5><span class="Clavander">URS</span> will be generated combaining Strands 0-7</h5>
                <span id="binarykey"></span>
            </blockquote>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 order-md-1">
            <div class="input-group mb-3">
                <div class="">
                    <button class="btn btn-warning" name="urs" id="urs" type="button">Generate URS file and Download</button>
                </div>
            </div>
            <span id="ursfile"></span>
        </div>
    </div>



    <hr>
    <div class="py-5 text-center">
        <h2 style="color: #007bff">XOR Extended UK with URS </h2>
        <p class="lead">Below is a form for generating modified URS.</p>
    </div>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <form enctype="multipart/form-data" id="xorForm" >
                <hr class="mb-4">
                <div class="form-group">
                    <label for="file">Extended UK File</label>
                    <input type="file" class="form-control" id="uk-file" name="uk-file" required />
                    <label for="file">Universal Random Sequence File</label>
                    <input type="file" class="form-control" id="urs-file" name="urs-file" required />
                </div>
                <select class="custom-select" id="bitwise" name="bitwise">
                    <option value="" selected>Please select logical operation method</option>
                    <option value=1> XOR </option>
                    <option value=0> XNOR </option>
                </select>
                <hr class="mb-4">
                <input type="submit" name="submit" class="btn btn-danger submitBtn" value="Submit"/>
            </form>
            <span id="mURS"></span>

        </div>
    </div>




    <hr>
    <div class="py-5 text-center">
        <h2 style="color: #007bff">Strands Rearranging </h2>
        <p class="lead">Below is a form for rearranging strands.</p>
    </div>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <form enctype="multipart/form-data" id="strands" >
                <hr class="mb-4">
                <div class="form-group">
                    <label for="file">Strand 0</label>
                    <input type="file" class="form-control" id="strand0" name="strand0" required />

                    <label for="file">Strand 1</label>
                    <input type="file" class="form-control" id="strand1" name="strand1" required />

                    <label for="file">Strand 2</label>
                    <input type="file" class="form-control" id="strand2" name="strand2" required />

                    <label for="file">Strand 3</label>
                    <input type="file" class="form-control" id="strand3" name="strand3" required />

                    <label for="file">Strand 4</label>
                    <input type="file" class="form-control" id="strand4" name="strand4" required />

                    <label for="file">Strand 5</label>
                    <input type="file" class="form-control" id="strand5" name="strand5" required />

                    <label for="file">Strand 6</label>
                    <input type="file" class="form-control" id="strand6" name="strand6" required />

                    <label for="file">Strand 7</label>
                    <input type="file" class="form-control" id="strand7" name="strand7" required />
                </div>
                <hr class="mb-4">
                <input type="submit" name="submit" class="btn btn-danger" value="Submit"/>
            </form>
            <span id="for-strand"></span>

        </div>
    </div>



    <hr>
    <div class="py-5 text-center">
        <h2 style="color: #007bff">First Pad! </h2>
        <p class="lead">Below is a form for First Pad generation.</p>
    </div>

    <div class="row">
        <div class="col-md-8 order-md-1">
            <form enctype="multipart/form-data" id="krr" >
                <hr class="mb-4">
                <div class="form-group">
                    <label for="file">KRR 0</label>
                    <input type="file" class="form-control" id="krr0" name="krr0" required />

                    <label for="file">KRR 1</label>
                    <input type="file" class="form-control" id="krr1" name="krr1" required />

                    <label for="file">KRR 2</label>
                    <input type="file" class="form-control" id="krr2" name="krr2" required />

                    <label for="file">KRR 3</label>
                    <input type="file" class="form-control" id="krr3" name="krr3" required />

                    <label for="file">KRR 4</label>
                    <input type="file" class="form-control" id="krr4" name="krr4" required />

                    <label for="file">KRR 5</label>
                    <input type="file" class="form-control" id="krr5" name="krr5" required />

                    <label for="file">KRR 6</label>
                    <input type="file" class="form-control" id="krr6" name="krr6" required />

                    <label for="file">KRR 7</label>
                    <input type="file" class="form-control" id="krr7" name="krr7" required />
                </div>
                <hr class="mb-4">
                <input type="submit" name="submit" class="btn btn-danger" value="Submit"/>
            </form>
            <span id="for-krr"></span>

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


<script>
    $(document).ready(function() {
        var request;
        $(document).on("click", '#userkey', function(event) {
            var url = 'action_userkey.php';
            // abort any pending request
            if (request) {
                request.abort();
            }

            var key = $('#key').val();
            key = key.replace(/\+/g, "%2B");
            //alert(key);

            // post to the backend script in ajax mode
            var serializedData = 'userkey='+key + '&action=convert';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    $("#binarykey").html(result);

                }).fail(function (jqXHR, textStatus, errorThrown){
                    // log the error to the console
                    console.error(
                        "The following error occured: "+
                        textStatus, errorThrown
                    );
                });

            // prevent default posting of form
            event.preventDefault();
        });
    });
</script>

<script>
    $(document).ready(function() {
        var request;
        $(document).on("click", '#expand', function(event) {
            var url = 'action_userkey.php';
            // abort any pending request
            if (request) {
                request.abort();
            }

            $("#expandedfile").empty();
            // post to the backend script in ajax mode
            var serializedData = 'userkey='+$('#key').val() + '&action=expand';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    $("#expandedfile").html('<a href="storage/userkey.txt" id="download" download>Download Userkey file</a><button class="btn btn-warning" name="uk-split" id="uk-split" type="button">Split into Eight files</button>');

                }).fail(function (jqXHR, textStatus, errorThrown){
                    // log the error to the console
                    console.error(
                        "The following error occured: "+
                        textStatus, errorThrown
                    );
                });

            // prevent default posting of form
            event.preventDefault();
        });
    });
</script>


<script>
    $(document).ready(function() {
        var request;
        $(document).on("click", '#uk-split', function(event) {
            var url = 'action_userkey.php';
            // abort any pending request
            if (request) {
                request.abort();
            }

            $("#split-files").empty();
            // post to the backend script in ajax mode
            var serializedData = 'userkey='+$('#key').val() + '&action=split';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    $("#split-files").html('<div class="row">\n' +
                        '        <div class="col-md-12 order-md-1">' +
                        '<ul class="list-group">\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 0.txt" id="download" download>Download Exp Key 0</a></li>\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 1.txt" id="download" download>Download Exp Key 1</a></li>\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 2.txt" id="download" download>Download Exp Key 2</a></li>\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 3.txt" id="download" download>Download Exp Key 3</a></li>\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 4.txt" id="download" download>Download Exp Key 4</a></li>\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 5.txt" id="download" download>Download Exp Key 5</a></li>\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 6.txt" id="download" download>Download Exp Key 6</a></li>\n' +
                        '  <li class="list-group-item"><a href="uks/Exp Key 7.txt" id="download" download>Download Exp Key 7</a></li>\n' +
                        '</ul>' +
                        '</div>' +
                        '</div>');

                }).fail(function (jqXHR, textStatus, errorThrown){
                    // log the error to the console
                    console.error(
                        "The following error occured: "+
                        textStatus, errorThrown
                    );
                });

            // prevent default posting of form
            event.preventDefault();
        });
    });
</script>


<script>
    $(document).ready(function() {
        var request;
        $(document).on("click", '#urs', function(event) {
            var url = 'action_urs.php';
            // abort any pending request
            if (request) {
                request.abort();
            }

            $("#expandedfile").empty();
            // post to the backend script in ajax mode
            var serializedData = 'action=generate';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    $("#ursfile").html('<a href="storage/URS.txt" id="download" download>Download generated URS file</a>');

                }).fail(function (jqXHR, textStatus, errorThrown){
                    // log the error to the console
                    console.error(
                        "The following error occured: "+
                        textStatus, errorThrown
                    );
                });

            // prevent default posting of form
            event.preventDefault();
        });
    });
</script>


<script>
    $(document).ready(function(e){
        $("#xorForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'action_xor.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){

                    var jsonData = JSON.parse(data);

                    $('#xorForm').css("opacity","");
                    $(".submitBtn").removeAttr("disabled");

                    if(jsonData == 1){
                        var notif = "Will be used XOR";
                    }
                    else {
                        notif = "Will be used XNOR";
                    }

                    $("#mURS").html('<h5><span class="Clavander">User Keys 185_th bit is: ' + jsonData +'</span>'+notif+'</h5>' +
                        '<a href="storage/XOR_URS.txt" id="download" download>Download generated URS file</a>');
                }
            });
        });
    });
</script>






<script>
    $(document).ready(function(e){
        $("#strands").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'action_strands.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){

                    var jsonData = JSON.parse(data);

                    $('#strands').css("opacity","");
                    $(".submitBtn").removeAttr("disabled");

                    $("#for-strand").html('<h5><span class="Clavander">Rearranging Points are: </span></h5>' +
                        '<ul class="list-group">\n' +
                        '  <li class="list-group-item">'+jsonData[0]+'</li>\n' +
                        '  <li class="list-group-item">'+jsonData[1]+'</li>\n' +
                        '  <li class="list-group-item">'+jsonData[2]+'</li>\n' +
                        '  <li class="list-group-item">'+jsonData[3]+'</li>\n' +
                        '  <li class="list-group-item">'+jsonData[4]+'</li>\n' +
                        '  <li class="list-group-item">'+jsonData[5]+'</li>\n' +
                        '  <li class="list-group-item">'+jsonData[6]+'</li>\n' +
                        '  <li class="list-group-item">'+jsonData[7]+'</li>\n' +
                        '</ul>');
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function(e){
        $("#krr").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'action_pad.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){

                    var jsonData = JSON.parse(data);

                    $('#krr').css("opacity","");
                    $(".submitBtn").removeAttr("disabled");

                    $("#for-krr").html('<h5><span class="Clavander">Rearranging Points are: </span>'+jsonData+'</h5>');
                }
            });
        });
    });
</script>

</body>
</html>