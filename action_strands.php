<?php

require_once "Strand.php";

$strand = new Strand();


if (is_ajax()) {
    //echo json_encode(var_dump($_FILES));
    if ($_FILES['strand0']['error'] == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['strand0']['tmp_name'])) { //checks that file is uploaded

        $file0 = $_FILES['strand0']['tmp_name'];
        $file1 = $_FILES['strand1']['tmp_name'];
        $file2 = $_FILES['strand2']['tmp_name'];
        $file3 = $_FILES['strand3']['tmp_name'];
        $file4 = $_FILES['strand4']['tmp_name'];
        $file5 = $_FILES['strand5']['tmp_name'];
        $file6 = $_FILES['strand6']['tmp_name'];
        $file7 = $_FILES['strand7']['tmp_name'];

        $ret = $strand->rearrangeStrands($file0, $file1, $file2, $file3, $file4, $file5, $file6, $file7);
        echo json_encode($ret);
    }

}

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
