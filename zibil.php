<?php

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

//echo stringToBinary("sevada");

$binary = "00100101010100000100010001000110001011010011000100101110001101000000110100100101";
$binaries = substr(chunk_split($binary, 8, ' '),0);
echo $binaries;
echo "<pre>";

echo base_convert('00100101010100000100010001000110001011010011000100101110001101000000110100100101', 2, 16);

echo "<pre>";

echo pack('H*', '2e');

