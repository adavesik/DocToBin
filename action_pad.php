<?php

require_once "XORClass.php";
require_once "UserKey.php";

$xor = new XORClass();


if (is_ajax()) {
    //echo json_encode(var_dump($_FILES));
    if ($_FILES['krr0']['error'] == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['krr0']['tmp_name'])) { //checks that file is uploaded

        $file0 = $_FILES['krr0']['tmp_name'];
        $file1 = $_FILES['krr1']['tmp_name'];
        $file2 = $_FILES['krr2']['tmp_name'];
        $file3 = $_FILES['krr3']['tmp_name'];
        $file4 = $_FILES['krr4']['tmp_name'];
        $file5 = $_FILES['krr5']['tmp_name'];
        $file6 = $_FILES['krr6']['tmp_name'];
        $file7 = $_FILES['krr7']['tmp_name'];


        //get XOR or XNOR bit for every step
        $method0 = UserKey::getLast24Bit($file0);
        $method1 = UserKey::getLast24Bit($file1);
        $method2 = UserKey::getLast24Bit($file2);
        $method3 = UserKey::getLast24Bit($file3);
        $method4 = UserKey::getLast24Bit($file4);
        $method5 = UserKey::getLast24Bit($file5);
        $method6 = UserKey::getLast24Bit($file6);

        /*
         * KRR0+1
         * KRR0+1+2
         * KRR0+1+2+3
         * KRR0+1+2+3+4
         * KRR0+1+2+3+4+5
         * KRR0+1+2+3+4+5+6
         * KRR0+1+2+3+4+5+6+7
         * */

        $xor->XorFiles($file0, $file1, $method0, "pads/KRR0+1.txt");
        $xor->XorFiles("pads/KRR0+1.txt", $file2, $method1, "pads/KRR0+1+2.txt");
        $xor->XorFiles("pads/KRR0+1+2.txt", $file3, $method2, "pads/KRR0+1+2+3.txt");
        $xor->XorFiles("pads/KRR0+1+2+3.txt", $file4, $method3, "pads/KRR0+1+2+3+4.txt");
        $xor->XorFiles("pads/KRR0+1+2+3+4.txt", $file5, $method4, "pads/KRR0+1+2+3+4+5.txt");
        $xor->XorFiles("pads/KRR0+1+2+3+4+5.txt", $file6, $method5, "pads/KRR0+1+2+3+4+5+6.txt");
        $xor->XorFiles("pads/KRR0+1+2+3+4+5+6.txt", $file7, $method6, "pads/KRR0+1+2+3+4+5+6+7.txt");

        if (!copy("pads/KRR0+1+2+3+4+5+6+7.txt", "pads/first pad.txt")) {
            echo "failed to copy file...\n";
        }

        echo json_encode("pads/first pad.txt");
    }

}

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
