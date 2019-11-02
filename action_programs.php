<?php

require_once "Strand.php";

$strand = new Strand();


if (is_ajax()) {
    //echo json_encode(var_dump($_FILES));
    if ($_FILES['file']['error'] == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['file']['tmp_name'])) { //checks that file is uploaded

        $returnData = array();
        $binaryFile = $_FILES['file']['tmp_name'];

        $userKeyFile = "storage/XORed_UserKey.txt";
        $handle = fopen($userKeyFile, 'rb');

        if ($handle === false) {
            return false;
        }

        $buffer = fread($handle, 714);

        ob_flush();
        flush();

        $pps_insertion_point = bindec(substr($buffer, 0, 10));

        for($i = 1; $i <= 64; $i++){


            $rearrangment_point = bindec(substr($buffer, 10*$i+($i-1), 10));
            $xor_xnor = $buffer[11*$i];

            $array = array(
                'pps' => $pps_insertion_point,
                'rearrangment_point' => $rearrangment_point,
                'xor_xnor' => $xor_xnor
            );

            $jsondata = json_encode($array, JSON_PRETTY_PRINT);
            if(file_put_contents("programs/". ($i-1) .".json", $jsondata)) {
                $returnData[] = "programs/". ($i-1) .".json";
            }
        }
        echo json_encode($returnData);
    }

}

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
