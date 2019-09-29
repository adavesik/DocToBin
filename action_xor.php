<?php

require_once "XORClass.php";
require_once "UserKey.php";

$xoring = new XORClass();

if (is_ajax()) {

    if(!empty($_POST['ursFile']) && !empty($_POST['ukFile'])) {
        $ret = $xoring->XorFiles($_POST['ursFile'], $_POST['ukFile'], 1);
        echo json_encode($ret);
    }

    //echo json_encode(var_dump($_FILES));
    if (!empty($_FILES['uk-file']['error']) == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['uk-file']['tmp_name'])) { //checks that file is uploaded
        //$uk_file = file_get_contents($_FILES['uk-file']['tmp_name']);
        //$urs_file = file_get_contents($_FILES['urs-file']['tmp_name']);

        //$bit = UserKey::get185Bit($_FILES['uk-file']['tmp_name']);
        $bit = $_POST['bitwise'];

        $ret = $xoring->XorFiles($_FILES['uk-file']['tmp_name'], $_FILES['urs-file']['tmp_name'], $bit);
        echo json_encode($bit);
    }

    }

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
