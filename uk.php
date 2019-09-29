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
        <div class="sidebar-heading">Start Cipher Modules</div>
        <div class="list-group list-group-flush">
            <a href="index_n.php" class="list-group-item list-group-item-action bg-light">Convert File to Binary</a>
            <a href="bin2file.php" class="list-group-item list-group-item-action bg-light">Binary to File</a>
            <a href="uk.php" class="list-group-item list-group-item-action bg-light">User Key</a>
            <a href="universal_rnd_seq.php" class="list-group-item list-group-item-action bg-light">Universal Random Sequence</a>
            <a href="xor.php" class="list-group-item list-group-item-action bg-light">XOR</a>
            <a href="rearranging.php" class="list-group-item list-group-item-action bg-light">Rearranging</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Pad Generation</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Pads Autogeneration</a>
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

        <div class="py-5 text-center">
            <h2 style="color: #007bff">User Key </h2>
            <p class="lead">Below is an example form built for converting binary files.</p>
        </div>
        <div class="row ml-2" id="binary">
            <div class="col-md-8 order-md-1">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="User Key" aria-label="User Key" id="key" aria-describedby="basic-addon2" maxlength="1666667">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" name="userkey" id="userkey" type="button">Convert To SixBit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ml-2" id="binary">
            <div class="col-md-8 order-md-1">
                <blockquote class="mint" id="userkeybinary">
                    <h5>User Key converted to <span class="Cmint">SixBit</span> binary form:</h5>
                    <span id="binarykey"></span>
                </blockquote>
            </div>
        </div>

        <div class="row ml-2">
            <div class="col-md-8 order-md-1">
                <div class="input-group mb-3">
                    <div class="">
                        <button class="btn btn-info" name="expand" id="expand" type="button">Expand to 2^26 and Download</button>
                    </div>
                </div>
                <span id="expandedfile"></span>
            </div>
        </div>

        <div class="row ml-2" id="split-files">
            <div class="col-md-8 order-md-1">
                <blockquote class="mint">
                    <h5>Bellow you can download <span class="Cmint">8</span> files:</h5>
                    <span id="split-files"></span>
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

</body>

</html>
