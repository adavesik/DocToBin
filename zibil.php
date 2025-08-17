<?php
require_once "BigFile.php";
// This commit shoul dwork
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
// Just a function to convert binary to string
// Commit made to test the commit
// This one should be final one
// Just a function to convert binary to string
// I have tiered 
function binaryToString($binary, $is_spaced = false)
{
    //nope
    if(!$is_spaced){

        $un_trimmed = chunk_split($binary, 8, ' ');
        $trimmed = rtrim($un_trimmed);

        $binaries = substr($trimmed,0);
        $binaries = explode(' ', $binaries);
    }
    else{
        $binaries = explode(' ', $binary);
    }

    //Another commit made
    $string = null;
    foreach ($binaries as $bin) {
        $string .= pack('H*', base_convert($bin, 2, 16));
    }

    return $string;
}

//Commit stupidly made
function bin2text( $bin )
{

    $text = '';
        # valid binary string, split, explode and other magic
        # prepare string for conversion
        $chars = explode( "\n", chunk_split( str_replace( "\n", '', $bin ), 8 ) );
        $char_count = count( $chars );

        # converting the characters one by one
        for( $i = 0; $i < $char_count; $text .= chr( bindec( $chars[$i] ) ), $i++ );

        # let's return the result
        return "Result: " . $text;

}

//echo stringToBinary("sevada");

$binary = "00100101010100000100010001000110001011010011000100101110001101100000110100100101111000101110001111001111110100110011011100100000001100000010000001101111011000100110101000001101001111000011110000101111010011000110100101101110011001010110000101110010011010010111101001100101011001000010000000110001001011110100110000100000001100110011100000110110001101000011001100101111010011110010000000111001001011110100010100100000001100110011001100110011001101000011000000101111010011100010000000110001001011110101010000100000001100110011100000110011001101010011010000101111010010000010000001011011001000000011010000111001001101110010000000110001001101010011100101011101001111100011111000001101011001010110111001100100011011110110001001101010000011010010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001100100011011100100000001100000010000001101111011000100110101000001101001111000011110000101111010001000110010101100011011011110110010001100101010100000110000101110010011011010111001100111100001111000010111101000011011011110110110001110101011011010110111001110011001000000011010000101111010100000111001001100101011001000110100101100011011101000110111101110010001000000011000100110010";

$un_trimmed = chunk_split($binary, 8, ' ');
$trimmed = rtrim($un_trimmed);

//var_dump($trimmed);

$binaries = substr($trimmed,0);
$binaries = explode(' ', $binaries);

//var_dump($binaries);

/*foreach ($binaries as $bin) {
    echo "Binary is: ".$bin;
    echo "<pre>";
    echo "Base convert is: ".base_convert($bin, 2, 16);
    echo "<pre>";
    echo "Ascii is: ".pack('H*', base_convert($bin, 2, 16));
    echo "<pre><hr>";

}*/


echo "<pre>";
//echo pack('H*', '2e');
//echo "Encoded is: ".bin2text($binary);



$largefile = new BigFile("CV.pdf");

$iterator = $largefile->iterate("Text"); // Text or Binary based on your file type

foreach ($iterator as $line) {

    echo $line;

}