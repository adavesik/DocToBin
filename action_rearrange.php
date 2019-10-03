<?php

require_once "Strand.php";

$strand = new Strand();


if (is_ajax()) {
    //echo json_encode(var_dump($_FILES));
    if (!empty($_POST['file0']) && !empty($_POST['file1']) && !empty($_POST['file2']) && !empty($_POST['file3']) && !empty($_POST['file4'])) { //checks that file is uploaded

        $file0 = $_POST['file0'];
        $file1 = $_POST['file1'];
        $file2 = $_POST['file2'];
        $file3 = $_POST['file3'];
        $file4 = $_POST['file4'];
        $file5 = $_POST['file5'];
        $file6 = $_POST['file6'];
        $file7 = $_POST['file7'];

        $ret = $strand->rearrangeStrands($file0, $file1, $file2, $file3, $file4, $file5, $file6, $file7);
        echo json_encode($ret);
    }

}

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
