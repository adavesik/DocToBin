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
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Binary file</h6>
                            </div>
                            <span class="text-muted" id="binary"></span>
                        </li>
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

</body>

</html>
