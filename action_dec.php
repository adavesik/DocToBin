<?php

require_once "Strand.php";
require_once "XORClass.php";

$strand = new Strand();
$xor = new XORClass();


if (is_ajax()) {

    $returnData = array();

    $pps = '';
    $programNumber = 0;


    if ($_FILES['file']['error'] == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['file']['tmp_name'])) {     //checks that file is uploaded
        echo json_encode("Encrypted File Successfully Uploaded!");
    }










    $action = $_POST['action'];

    switch ($action){
        case 'pps':
            $padUsed = "pads/1.txt";
            $handle = fopen($padUsed, 'rb');

            if ($handle === false) {
                return false;
            }

            $buffer = fread($handle, 48);

            ob_flush();
            flush();

            $pps = substr($buffer, 0, 42);
            $programNumber = bindec(substr($buffer, 42, 48));

            $returnData['pps'] = $pps;
            $returnData['programNumber'] = $programNumber;

            $jsondata = json_encode($returnData);
            file_put_contents("configs/decryption.json", $jsondata);

            echo json_encode($returnData);
            break;

        case 'fetchprogdata':

            //Get data from existing json file
            $jsondata = file_get_contents("configs/decryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $arr_data = json_decode($jsondata, true);
            $arr_data['file'] = $progFile;
            echo json_encode($arr_data);
            break;

        case 'removepps':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/decryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $ppsPoint = $prog_data['pps'];


            $c_text = file_get_contents("storage/converted/dog.ge1");
            $str = substr($c_text, 0, $ppsPoint) . substr($c_text, $ppsPoint+42, strlen($c_text));
            file_put_contents("storage/converted/dog_without_pps.ge1", $str);

            echo json_encode(strlen($c_text));
            break;


        /*case 'xor':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/decryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $method = $prog_data['xor_xnor'];

            $cnt = $xor->XorFiles("storage/converted/dog_rearranged.ge1", "pads/1.txt", $method, "storage/converted/decrypted_dog.txt");

            echo json_encode($cnt);

            break;

        case 'rearrange':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/decryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $rearrangementPoint = $prog_data['rearrangment_point'];


            $ptext = file_get_contents("storage/converted/dog_without_pps.ge1");
            $lenOfPtext = strlen($ptext);

            $str = substr($ptext, -$rearrangementPoint, $rearrangementPoint) . substr($ptext, 0, $lenOfPtext - $rearrangementPoint);

            file_put_contents("storage/converted/dog_rearranged.ge1", $str);

            $returnData['rearragnementPoint'] = $rearrangementPoint;

            echo json_encode($returnData);
            break;*/


































        case 'rearrange':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/decryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $method = $prog_data['xor_xnor'];

            $cnt = $xor->XorFiles("storage/converted/dog_without_pps.ge1", "pads/1.txt", $method, "storage/converted/dog_xored.ge1");

            echo json_encode($cnt);

            break;

        case 'xor':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/decryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $rearrangementPoint = $prog_data['rearrangment_point'];


            $ptext = file_get_contents("storage/converted/dog_xored.ge1");
            $lenOfPtext = strlen($ptext);

            $str = substr($ptext, -$rearrangementPoint, $rearrangementPoint) . substr($ptext, 0, $lenOfPtext - $rearrangementPoint);

            file_put_contents("storage/converted/decrypted_dog.txt", $str);

            $returnData['rearragnementPoint'] = $rearrangementPoint;

            echo json_encode($returnData);
            break;

    }
}

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
