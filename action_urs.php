<?php

require_once 'Urs.php';

if (is_ajax()) {
    if (isset($_POST["action"])) { //Checks if action value exists (!empty($_POST["userkey"]))
        $action = $_POST["action"];
        //$userkey = $_POST["userkey"];
        //$keydata = "";

        $urs = new Urs();

        switch($action) {

            case "generate":

                $res = $urs->makeURS("strands/0-2019-08-03.txt", "strands/1-2018-10-17.txt", "strands/2-2018-09-28.txt",
                    "strands/3-2019-09-02.txt", "strands/4-2019-02-05.txt", "strands/5-2018-12-22.txt",
                    "strands/6-2019-01-06.txt", "strands/7-2019-03-14.txt");
                echo json_encode($res);
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
