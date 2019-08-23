<?php
require_once 'BigFile.php';

function stringToBinary($string)
{
    $characters = str_split($string);

    $binary = [];
    foreach ($characters as $character) {
        $data = unpack('H*', $character);
        $binary[] = base_convert($data[1], 16, 2);
    }

    return implode(' ', $binary);
}


function reconvert($bin_nr) {
    $base=1;
    $dec_nr=0;
    $bin_nr=explode(",", preg_replace("/(.*),/", "$1", str_replace("1", "1,", str_replace("0", "0,", $bin_nr))));
    for($i=1; $i<count($bin_nr); $i++) $base=$base*2;
    foreach($bin_nr as $key=>$bin_nr_bit) {
        if($bin_nr_bit==1) {
            $dec_nr+=$base;
            $base=$base/2;
        }
        if($bin_nr_bit==0) $base=$base/2;
    }
    return(array("string"=>chr($dec_nr), "int"=>$dec_nr));
}

function bindecc($str)
{
    $str = str_replace(" ", "", $str);
    $strr = preg_match('/[^01]/', $str);
    if($strr == 1) { return "<b> Error ! only 1 and 0;</b>"; }
    $strsig = strlen($str);
    $strr1 = strrev($str);
    $strf = '';
    for($i = $strsig; $i >= 0; $i--)
    {
        $strf += ($strr1[$i] * pow(2, $i));
        #$strf += $str[$i];
    }
    return $strf;
}


function textBinASCII($text){
    $bin = array();
    for($i=0; strlen($text)>$i; $i++){
        $b_chunk = decbin(ord($text[$i]));
        switch (strlen($b_chunk)){

            case 6:
                $b_chunk = "00".$b_chunk;
                break;
            default:
                break;
        }

        $bin[] = $b_chunk;
    }
    return implode(' ',$bin);
}



function ASCIIBinText($bin){
    $text = array();
    $bin = explode(" ", $bin);
    for($i=0; count($bin)>$i; $i++)
        $text[] = chr(bindec($bin[$i]));

    return implode($text);
}
//echo pack('H*', dechex(base_convert("1101001101011010000101001111101001011101111100001001011100011111001111101111100000110000011000001100000110011101010", 2, 16)));
//print_r(bindecc("1101001101011010000101001111101001011101111100001001011100011111001111101111100000110000011000001100000110011101010"));


/*$chunkSize = 57 * 143;
$src = fopen('arch.zip', 'rb');
$dst = fopen('storage/converted/binary.data', 'wb');
while (!feof($src)) {
    $plain = fread($src, 57 * 143);
    $encoded = base64_encode($plain);
    $encoded = chunk_split($encoded, 76, "\r\n");
    fwrite($dst, $encoded);
}
fclose($dst);
fclose($src);*/


echo textBinASCII("==");

echo "<pre>";

echo ASCIIBinText("00111101 00111101");


/*$chunkSize = 8;
$src = fopen('storage/converted/bindata.txt', 'rb');
$dst = fopen('storage/converted/space_binary.txt', 'wb');
while (!feof($src)) {
    $plain = fread($src, $chunkSize);
    //$encoded = base64_encode($plain);
    $encoded = substr(chunk_split($plain, 8, ' '),0);
    //$encoded .= ' ';
    fwrite($dst, $encoded);
}
fclose($dst);
fclose($src);*/


$largefile = new BigFile("gram.pdf");

$iterator = $largefile->iterate("Binary"); // Text or Binary based on your file type

foreach ($iterator as $line) {

    echo $line;

}