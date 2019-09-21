<?php

require_once "XORClass.php";

$xoring = new XORClass();

if (is_ajax()) {
    //echo json_encode(var_dump($_FILES));
    if ($_FILES['uk-file']['error'] == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['uk-file']['tmp_name'])) { //checks that file is uploaded
        //$uk_file = file_get_contents($_FILES['uk-file']['tmp_name']);
        //$urs_file = file_get_contents($_FILES['urs-file']['tmp_name']);

        $ret = $xoring->XorFiles($_FILES['uk-file']['tmp_name'], $_FILES['urs-file']['tmp_name']);
        echo json_encode($ret);
    }

    }

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
