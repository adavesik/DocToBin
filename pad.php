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
        <div class="sidebar-heading">Cipher Modules</div>
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

        <div class="py-5 text-center">
            <h2 style="color: #007bff">Single Pad! </h2>
            <p class="lead">Below is a form for Single Pad generation.</p>
        </div>

        <div class="row ml-2">
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
