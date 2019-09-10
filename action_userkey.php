<?php
require_once 'UserKey.php';

if (is_ajax()) {
    if (isset($_POST["userkey"])) { //Checks if action value exists (!empty($_POST["userkey"]))
        $action = $_POST["action"];
        $userkey = $_POST["userkey"];
        $keydata = "";

        $uk = new UserKey($userkey);

        switch($action) {

            case "convert":

                $key = $uk->getUserKey();
                $keydata = $uk->convertToBinary($key);
                echo json_encode($keydata);
                break;


            case "expand":
                $key = $uk->getUserKey();
                $keydata = $uk->convertToBinary($key);
                $uk->expandUserKey($keydata);
                break;
        }

    }}


/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
