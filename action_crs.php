<?php

require_once "XORClass.php";
require_once "UserKey.php";
require_once 'Urs.php';
require_once 'Strand.php';
require_once 'CRS.php';

$xor = new XORClass();
$urs = new Urs();
$strand = new Strand();
$crs = new CRS();


if (is_ajax()) {

    $padsArray = [];

    $padCount = $_POST['padCount'];

    //Step 1 - User Key
    if ( $_FILES['file']['error'] == UPLOAD_ERR_OK               //checks for errors
        && is_uploaded_file($_FILES['file']['tmp_name'])) {

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
                //echo json_encode("storage/userkey.txt");
            }else{
                echo json_encode("Upload failed , try later !");
            }
        }

    }

    PSP("prs/0-prs.txt");
    PSP("prs/1-prs.txt");
    PSP("prs/2-prs.txt");
    PSP("prs/3-prs.txt");
    PSP("prs/4-prs.txt");
    PSP("prs/5-prs.txt");
    PSP("prs/6-prs.txt");
    PSP("prs/7-prs.txt");

    //Step 2 - PRS
    $res = $urs->makeURS("prs/0-prs.txt", "prs/1-prs.txt", "prs/2-prs.txt",
        "prs/3-prs.txt", "prs/4-prs.txt", "prs/5-prs.txt",
        "prs/6-prs.txt", "prs/7-prs.txt", "prs/PRS.txt");


    $point = bindec(UserKey::getFirst6Bits("storage/userkey.txt"));
    $combining_method = UserKey::getFirst24Bit("storage/userkey.txt");

    if($point>=0 && $point<=15){
        $crs = "crs/crs0.txt";
        PSP($crs);
    }
    elseif ($point>=16 && $point<=31){
        $crs = "crs/crs1.txt";
        PSP($crs);
    }
    elseif ($point>=32 && $point<=47){
        $crs = "crs/crs2.txt";
        PSP($crs);
    }
    elseif ($point>=48 && $point<=63){
        $crs = "crs/crs3.txt";
        PSP($crs);
    }

    //Step 3 - XOR USerKey with URS
    $cnt = $uk->splitIntoEight("storage/userkey.txt", "tmp");

    PSP("tmp/Exp Key 0.txt");
    PSP("tmp/Exp Key 1.txt");
    PSP("tmp/Exp Key 2.txt");
    PSP("tmp/Exp Key 3.txt");
    PSP("tmp/Exp Key 4.txt");
    PSP("tmp/Exp Key 5.txt");
    PSP("tmp/Exp Key 6.txt");
    PSP("tmp/Exp Key 7.txt");

    $ret = $xor->XorFiles($crs, "tmp/Exp Key 0.txt", $combining_method, "tmp/xored.txt");
    $res = $urs->makeURS("tmp/xored.txt", "tmp/Exp Key 1.txt", "tmp/Exp Key 2.txt",
        "tmp/Exp Key 3.txt", "tmp/Exp Key 4.txt", "tmp/Exp Key 5.txt",
        "tmp/Exp Key 6.txt", "tmp/Exp Key 7.txt", "prs/xored.txt");

    $ret = $xor->XorFiles("prs/PRS.txt", "prs/xored.txt", 1);


    //Step 4 - split
    $cnt = $uk->splitIntoEight("storage/XORed_UserKey.txt");


    //Step 5 - Rearranging
    $file0 = 'uks/Exp Key 0.txt';
    $file1 = 'uks/Exp Key 1.txt';
    $file2 = 'uks/Exp Key 2.txt';
    $file3 = 'uks/Exp Key 3.txt';
    $file4 = 'uks/Exp Key 4.txt';
    $file5 = 'uks/Exp Key 5.txt';
    $file6 = 'uks/Exp Key 6.txt';
    $file7 = 'uks/Exp Key 7.txt';

    $ret = $strand->rearrangeStrands($file0, $file1, $file2, $file3, $file4, $file5, $file6, $file7);


    //Step 6 - First Pad
    $krr0 = 'strands/rearranged/0-KeyRandomizedRearranged.txt';
    $krr1 = 'strands/rearranged/1-KeyRandomizedRearranged.txt';
    $krr2 = 'strands/rearranged/2-KeyRandomizedRearranged.txt';
    $krr3 = 'strands/rearranged/3-KeyRandomizedRearranged.txt';
    $krr4 = 'strands/rearranged/4-KeyRandomizedRearranged.txt';
    $krr5 = 'strands/rearranged/5-KeyRandomizedRearranged.txt';
    $krr6 = 'strands/rearranged/6-KeyRandomizedRearranged.txt';
    $krr7 = 'strands/rearranged/7-KeyRandomizedRearranged.txt';

    //get XOR or XNOR bit for every step
    $method0 = UserKey::getLast24Bit($krr0);
    $method1 = UserKey::getLast24Bit($krr1);
    $method2 = UserKey::getLast24Bit($krr2);
    $method3 = UserKey::getLast24Bit($krr3);
    $method4 = UserKey::getLast24Bit($krr4);
    $method5 = UserKey::getLast24Bit($krr5);
    $method6 = UserKey::getLast24Bit($krr6);

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

    $firstPadName = substr(md5(rand(1111,9999)),0,8).rand(1111,1000).rand(99,9999)." pad.txt";
    if (!copy("pads/KRR0+1+2+3+4+5+6+7.txt", "pads/".$firstPadName)) {
        echo "failed to copy file...\n";
    }
    else{
        $padsArray[] = "pads/".$firstPadName;
    }


    for ($i = 1; $i < $padCount; $i++){
        //rearrange prev pad
        $padFileName = $padsArray[$i-1];
        $point = bindec(UserKey::getLast23Bits($padFileName));
        $strand->rearrangeFile( $padFileName, $padFileName, $point);
        $padFileName = "strands/rearranged/".$padFileName;

        //XOR KRR's with Prev Pad
        $xor->XorFiles($krr0, $padFileName, 1, "tmp/KRP0.txt");
        $xor->XorFiles($krr1, $padFileName, 1, "tmp/KRP1.txt");
        $xor->XorFiles($krr2, $padFileName, 1, "tmp/KRP2.txt");
        $xor->XorFiles($krr3, $padFileName, 1, "tmp/KRP3.txt");
        $xor->XorFiles($krr4, $padFileName, 1, "tmp/KRP4.txt");
        $xor->XorFiles($krr5, $padFileName, 1, "tmp/KRP5.txt");
        $xor->XorFiles($krr6, $padFileName, 1, "tmp/KRP6.txt");
        $xor->XorFiles($krr7, $padFileName, 1, "tmp/KRP7.txt");

        //Rearragne KRP's. Will be saved as "strands/rearranged/KRRP.txt, etc..
        $strand->rearrangeAnyFiles("tmp/KRP0.txt", "tmp/KRP1.txt", "tmp/KRP2.txt", "tmp/KRP3.txt",
            "tmp/KRP4.txt", "tmp/KRP5.txt", "tmp/KRP6.txt", "tmp/KRP7.txt", $i);

        //get XOR or XNOR bit for every step
        $method0 = UserKey::getLast24Bit("strands/rearranged/KR".$i."RP0.txt");
        $method1 = UserKey::getLast24Bit("strands/rearranged/KR".$i."RP1.txt");
        $method2 = UserKey::getLast24Bit("strands/rearranged/KR".$i."RP2.txt");
        $method3 = UserKey::getLast24Bit("strands/rearranged/KR".$i."RP3.txt");
        $method4 = UserKey::getLast24Bit("strands/rearranged/KR".$i."RP4.txt");
        $method5 = UserKey::getLast24Bit("strands/rearranged/KR".$i."RP5.txt");
        $method6 = UserKey::getLast24Bit("strands/rearranged/KR".$i."RP6.txt");

        $file0 = "strands/rearranged/KR".$i."RP0.txt";
        $file1 = "strands/rearranged/KR".$i."RP1.txt";
        $file2 = "strands/rearranged/KR".$i."RP2.txt";
        $file3 = "strands/rearranged/KR".$i."RP3.txt";
        $file4 = "strands/rearranged/KR".$i."RP4.txt";
        $file5 = "strands/rearranged/KR".$i."RP5.txt";
        $file6 = "strands/rearranged/KR".$i."RP6.txt";
        $file7 = "strands/rearranged/KR".$i."RP7.txt";

        $xor->XorFiles($file0, $file1, $method0, "pads/KRR0+1.txt");
        $xor->XorFiles("pads/KRR0+1.txt", $file2, $method1, "pads/KRR0+1+2.txt");
        $xor->XorFiles("pads/KRR0+1+2.txt", $file3, $method2, "pads/KRR0+1+2+3.txt");
        $xor->XorFiles("pads/KRR0+1+2+3.txt", $file4, $method3, "pads/KRR0+1+2+3+4.txt");
        $xor->XorFiles("pads/KRR0+1+2+3+4.txt", $file5, $method4, "pads/KRR0+1+2+3+4+5.txt");
        $xor->XorFiles("pads/KRR0+1+2+3+4+5.txt", $file6, $method5, "pads/KRR0+1+2+3+4+5+6.txt");
        $xor->XorFiles("pads/KRR0+1+2+3+4+5+6.txt", $file7, $method6, "pads/KRR0+1+2+3+4+5+6+7.txt");

        $nextPadName = substr(md5(rand(1111,9999)),0,8).rand(1111,1000).rand(99,9999)." pad.txt";
        if (!copy("pads/KRR0+1+2+3+4+5+6+7.txt", "pads/".$nextPadName)) {
            echo "failed to copy file...\n";
        }
        else{
            $padsArray[] = "pads/".$nextPadName;
            $padsArray[] = $crs;
        }
    }

    echo json_encode($padsArray);

}

/*-------------------------------------------------*/
//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

//Prime Set Permutation
function PSP($filename){
    $handle = fopen($filename, 'rb');

    if ($handle === false) {
        return false;
    }

    $buffer = fread($handle, filesize($filename));

    $start = substr($buffer, 0, 23);
    $start = bindec($start);

    $jump = substr($buffer, 23, 23);
    $jump = bindec($jump);

    if($jump == 0){
        $jump = 1;
    }

    $buffer = $buffer."zzzzzzzzz";

    $file = new SplFileObject($filename, "w");

    $index = $start;

    $data = $buffer[$start];

    for ($i = 0; $i < 8388616; $i++) {

        $index = ($index+$jump)%8388617;
        $data.= $buffer[$index];
        //echo $buffer[$index];
    }
    $data = preg_replace("/z/", "", $data);
    $written = $file->fwrite($data);
    fclose($file);
}