<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lovely cipher of codebreakers </title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Cipher Modules </div>
        <div class="list-group list-group-flush">
            <a href="index_n.php" class="list-group-item list-group-item-action bg-light">Convert File to Binary</a>
            <a href="bin2file.php" class="list-group-item list-group-item-action bg-light">Binary to File</a>
            <a href="uk.php" class="list-group-item list-group-item-action bg-light">User Key</a>
            <a href="universal_rnd_seq.php" class="list-group-item list-group-item-action bg-light">Universal Random Sequence</a>
            <a href="xor.php" class="list-group-item list-group-item-action bg-light">XOR</a>
            <a href="rearranging.php" class="list-group-item list-group-item-action bg-light">Rearranging</a>
            <a href="pad.php" class="list-group-item list-group-item-action bg-light">Pad Generation</a>
            <a href="auto_pad.php" class="list-group-item list-group-item-action bg-light">Pads Autogeneration</a>
            <a href="auto_pad_file.php" class="list-group-item list-group-item-action bg-light">Upload UserKey as a File</a>
            <a href="with_crs.php" class="list-group-item list-group-item-action bg-light">Using CRS</a>
            <a href="user_freestand.php" class="list-group-item list-group-item-action bg-light">Free For Users</a>
            <a href="enc.php" class="list-group-item list-group-item-action bg-light">Encrypt</a>
            <a href="dec.php" class="list-group-item list-group-item-action bg-light">Decrypt</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </nav>

        <div class="container-fluid">
            <div class="py-5 text-center">
                <h2>Files Decryption Page</h2>
                <p class="lead">Below is an example form built for decrypting PNG files.</p>
            </div>

            <div class="row py-5" id="parsed">
                <div class="col-md-8 order-md-1">
                    <p class="statusMsg"></p>
                    <form enctype="multipart/form-data" id="fupForm" >
                        <hr class="mb-4">
                        <div class="form-group">
                            <label for="file">Upload ge1 File</label>
                            <input type="file" class="form-control" id="file" name="file" required />
                        </div>
                        <hr class="mb-4">
                        <input type="submit" name="submit" class="btn btn-danger submitBtn" value="Submit"/>
                    </form>
                </div>
            </div>

            <div class="row ml-2 py-5" id="progfiles" style="display: none">
                <div class="col-md-8 order-md-1">
                    <blockquote class="mint">
                        <h5>Generated <span class="Cmint">64</span> First 10 Program files are:</h5>
                        <span id="programs"></span>
                    </blockquote>
                    <hr class="mb-4">
                    <input type="button" name="" class="btn btn-success btnPad" id="btnPad" value="Next Step"/>
                </div>
            </div>

            <div class="row ml-2 py-5" id="pad-pps" style="display: none">
                <div class="col-md-8 order-md-1">
                    <blockquote class="mint">
                        <h5>Generated <span class="Cmint">PPS & Program Numbers</span> are:</h5>
                        <span id="pps"></span>
                    </blockquote>
                    <hr class="mb-4">
                    <input type="button" name="" class="btn btn-success btnProgData" id="btnProgData" value="Next Step"/>
                </div>
            </div>


            <div class="row ml-2 py-5" id="prog-data" style="display: none">
                <div class="col-md-8 order-md-1">
                    <blockquote class="mint">
                        <h5>Fetch information <span class="Cmint">about </span> selected program:</h5>
                        <span id="programdata"></span>
                    </blockquote>
                    <hr class="mb-4">
                    <input type="button" name="" class="btn btn-success btnRearrange" id="btnRearrange" value="Next Step"/>
                </div>
            </div>


            <div class="row ml-2 py-5" id="p-text-rearrange" style="display: none">
                <div class="col-md-8 order-md-1">
                    <blockquote class="mint">
                        <h5>Rearranging <span class="Cmint">C-Text </span> successfully finished:</h5>
                        <span id="rearrange"></span>
                    </blockquote>
                    <hr class="mb-4">
                    <input type="button" name="" class="btn btn-success btnPps" id="btnPps" value="Next Step"/>
                </div>
            </div>


            <div class="row ml-2 py-5" id="p-text-xor" style="display: none">
                <div class="col-md-8 order-md-1">
                    <blockquote class="mint">
                        <h5>Logical <span class="Cmint">operation </span> used:</h5>
                        <span id="xor"></span>
                    </blockquote>
                    <hr class="mb-4">
                    <input type="button" name="" class="btn btn-success btnXor" id="btnXor" value="Next Step"/>
                </div>
            </div>


            <div class="row ml-2 py-5" id="p-text-pps" style="display: none">
                <div class="col-md-8 order-md-1">
                    <blockquote class="mint">
                        <span id="pps_info"></span>
                    </blockquote>
                </div>
            </div>

        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="js/holder.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

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
                url: 'action_dec.php',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data){
                    $('.statusMsg').html('');

                    var jsonData = JSON.parse(data);

                    $("#programs").empty();
                    $('#progfiles').css('display', '');
                    $('#programs').append('<h5>'+jsonData+'</h5>');
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function() {
        var request;
        $(document).on("click", '#btnPad', function(event) {
            var url = 'action_dec.php';
            // abort any pending request
            if (request) {
                request.abort();
            }
            // post to the backend script in ajax mode
            var serializedData = 'action=pps';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    var jsonData = JSON.parse(result);

                    $("#pps").empty();
                    $('#pad-pps').css('display', '');
                    $("#pps").html('<h5>PPS is:'+ jsonData.pps+'</h5></br><h5>Program was used: '+ jsonData.programNumber+'</h5>');

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
        $(document).on("click", '#btnProgData', function(event) {
            var url = 'action_dec.php';
            // abort any pending request
            if (request) {
                request.abort();
            }
            // post to the backend script in ajax mode
            var serializedData = 'action=fetchprogdata';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    var jsonData = JSON.parse(result);

                    $("#programdata").empty();
                    $('#prog-data').css('display', '');
                    $("#programdata").html('<h5>PPS insertion point:'+ jsonData.pps+'</h5></br>' +
                        '<h5>Rearrangement Point is: '+ jsonData.rearrangment_point+'</h5></br>' +
                        '<h5>XOR or XNOR will be used: '+jsonData.xor_xnor+ '</h5>');

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
        $(document).on("click", '#btnRearrange', function(event) {
            var url = 'action_dec.php';
            // abort any pending request
            if (request) {
                request.abort();
            }
            // post to the backend script in ajax mode
            var serializedData = 'action=removepps';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    var jsonData = JSON.parse(result);

                    $("#rearrange").empty();
                    $('#p-text-rearrange').css('display', '');
                    $("#rearrange").html('<h5> ' + jsonData+ ' </h5>');

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
        $(document).on("click", '#btnXor', function(event) {
            var url = 'action_dec.php';
            // abort any pending request
            if (request) {
                request.abort();
            }
            // post to the backend script in ajax mode
            var serializedData = 'action=xor';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    var jsonData = JSON.parse(result);

                    $("#pps_info").empty();
                    $('#p-text-pps').css('display', '');
                    $("#pps_info").html('<h5>Was used ' + jsonData+ ' .</h5>');

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
        $(document).on("click", '#btnPps', function(event) {
            var url = 'action_dec.php';
            // abort any pending request
            if (request) {
                request.abort();
            }
            // post to the backend script in ajax mode
            var serializedData = 'action=rearrange';

            // fire off the request
            request = $.ajax({
                url: url,
                type: "post",
                datatype: "json",
                data: serializedData
            })
                .done(function (result, textStatus, jqXHR){

                    var jsonData = JSON.parse(result);

                    $("#xor").empty();
                    $('#p-text-xor').css('display', '');
                    $("#xor").html('<h5>C-Text Rearrangement Point- ' + jsonData.rearragnementPoint + ' .</h5></br>');

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

</body>

</html>
