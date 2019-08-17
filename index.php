<?php
/*
 * We try to convert doc to base64, then
 * base64 to binary, then
 * binary to base64. then
 * base64 to doc
 *
 * */

//read the doc file
$cc =  file_get_contents("WordExample.doc");
$encoded = base64_encode($cc);
file_put_contents('temp.txt', $encoded);

//now we need to convert base64 string which is in temp.txt to binary file

//get temp.txt file content
$b64content = file_get_contents('temp.txt');

//convert base64 to binary
$bindata = stringToBinary($b64content);
file_put_contents('bindata.txt', $bindata);

//convert binary data into base64
$data = file_get_contents("bindata.txt");
$cb64 = binaryToString($data);

//convert base64 back to doc


/**
 * @param $string
 * @return string
 */
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

/**
 * @param $binary
 * @return string|null
 */
function binaryToString($binary)
{
    $binaries = explode(' ', $binary);

    $string = null;
    foreach ($binaries as $binary) {
        $string .= pack('H*', dechex(bindec($binary)));
    }

    return $string;
}

/**
 * @param $inputfile
 * @param $outputfile
 * @return mixed
 */
function base64_to_doc($inputfile, $outputfile ) {
    /* read data (binary) */
    $ifp = fopen( $inputfile, "rb" );
    $imageData = fread( $ifp, filesize( $inputfile ) );
    fclose( $ifp );
    /* encode & write data (binary) */
    $ifp = fopen( $outputfile, "wb" );
    fwrite( $ifp, base64_decode( $imageData ) );
    fclose( $ifp );
    /* return output filename */
    return( $outputfile );
}