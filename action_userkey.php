<?php

require_once 'UserKey.php';

if (is_ajax()) {
    if (isset($_POST["userkey"]) || isset($_POST["action"])) { //Checks if action value exists (!empty($_POST["userkey"]))
        $action = $_POST["action"];
        $userkey = $_POST["userkey"];
        $keydata = "";

        $uk = new UserKey($userkey);

        switch($action) {

            case "convert":

                $key = $uk->getUserKey();
                $keydata = $uk->convertToBinary($key);
                //$uk_len = strlen($keydata);
                echo json_encode($keydata);
                break;


            case "expand":
                $key = $uk->getUserKey();
                $keydata = $uk->convertToBinary($key);
                $val = $uk->expandUserKey($keydata);
                echo json_encode($val);
                break;

            case "split":
                $cnt = $uk->splitIntoEight("storage/XORed_UserKey.txt");
                echo json_encode($cnt);
                break;
        }

    }

    elseif ( $_FILES['file']['error'] == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['file']['tmp_name']) ) {

        $userKeyFile = $_FILES['file']['tmp_name'];
        $keySize = UserKey::getUserKeyLenght($userKeyFile);

        if ($keySize < 67108864){
            $key = file_get_contents($userKeyFile);
            $uk = new UserKey($key);
            //$keydata = $uk->convertToBinary($key);
            $val = $uk->expandUserKey($key);
            echo json_encode($val);
        }
        else{
            if(move_uploaded_file($_FILES[$userKeyFile]["tmp_name"],"storage/userkey.txt")){
                echo json_encode("storage/userkey.txt");
            }else{
                echo json_encode("Upload failed , try later !");
            }
        }

    }
}


/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
