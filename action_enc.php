<?php

require_once "Strand.php";
require_once "XORClass.php";

$strand = new Strand();
$xor = new XORClass();


if (is_ajax()) {

    $returnData = array();

    $pps = '';
    $programNumber = 0;

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
            file_put_contents("configs/encryption.json", $jsondata);

            echo json_encode($returnData);
            break;

        case 'fetchprogdata':

            //Get data from existing json file
            $jsondata = file_get_contents("configs/encryption.json");
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

        case 'rearrange':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/encryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $rearrangementPoint = $prog_data['rearrangment_point'];

            $p_text = file_get_contents("storage/converted/bindata.txt");
            $ptextlen = strlen($p_text);
            if($ptextlen > $rearrangementPoint){
                $strand->rearrangeFile("storage/converted/bindata.txt", "r_p-text.txt", $rearrangementPoint, "storage/converted/");
            }
            else{
                $rearrangementPoint = $rearrangementPoint % $ptextlen;
                $strand->rearrangeFile("storage/converted/bindata.txt", "r_p-text.txt", $rearrangementPoint, "storage/converted/");
            }

            echo json_encode($rearrangementPoint);
            break;


        case 'xor':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/encryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $method = $prog_data['xor_xnor'];

            $xor->XorFiles("storage/converted/r_p-text.txt", "pads/1.txt", $method, "storage/converted/x_p-text.txt");

            echo json_encode($method);

            break;

        case 'insert_pps':
            //Get data from existing json file
            $jsondata = file_get_contents("configs/encryption.json");
            // converts json data into array
            $arr_data = json_decode($jsondata, true);

            $progFile = "programs/".$arr_data['programNumber'].".json";
            //Get data from existing json file
            $jsondata = file_get_contents($progFile);
            // converts json data into array
            $prog_data = json_decode($jsondata, true);

            $pps = $arr_data['pps'];
            $ppsPoint = $prog_data['pps'];


            $ptext = file_get_contents("storage/converted/x_p-text.txt");

            $str = substr($ptext, 0, $ppsPoint) . $pps . substr($ptext, $ppsPoint);

            file_put_contents("storage/converted/dog.ge1", $str);

            $returnData['pps'] = $pps;
            $returnData['ppsPoint'] = $ppsPoint;

            echo json_encode($returnData);
            break;

    }
}

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
