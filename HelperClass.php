<?php

class HelperClass
{
    /**
     * @param $string
     * @return string
     */
    public static function stringToBinary($string, $space = true)
    {
        $characters = str_split($string);

        $binary = [];
        foreach ($characters as $character) {
            $data = unpack('H*', $character);

            $b_chunk = base_convert($data[1], 16, 2);

            switch (strlen($b_chunk)){
                case 7:
                    $b_chunk = "0".$b_chunk;
                    break;
                case 6:
                    $b_chunk = "00".$b_chunk;
                    break;
                case 5:
                    $b_chunk = "000".$b_chunk;
                    break;
                case 4:
                    $b_chunk = "0000".$b_chunk;
                    break;
                case 3:
                    $b_chunk = "00000".$b_chunk;
                    break;
                case 2:
                    $b_chunk = "000000".$b_chunk;
                    break;
                case 1:
                    $b_chunk = "0000000".$b_chunk;
                    break;
                default:
                    break;
            }

            $binary[] = $b_chunk;//base_convert($data[1], 16, 2);
        }

        if(!$space){
            return implode('', $binary); //without spaces
        }
        else{
            return implode(' ', $binary); //with spaces
        }
    }

    /**
     * @param $binary
     * @param bool $is_spaced
     * @return string|null
     */
    public static function binaryToString($binary, $is_spaced = true)
    {
        if(!$is_spaced){
            $binaries = substr(chunk_split($binary, 8, ' '),0);
            $binaries = explode(' ', $binaries);
        }
        else{
            $binaries = explode(' ', $binary);
        }

        $string = null;
        foreach ($binaries as $bin) {
            $string .= pack('H*', base_convert($bin, 2, 16));
        }

        return $string;
    }


    /* Generates random filename and extension */
    public static function tempnam_sfx($path, $suffix){

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }

        do {
            $file = $path . DIRECTORY_SEPARATOR . mt_rand () . $suffix;
        } while (file_exists($file));

        return $file;
    }


    public function fillUpBinaryData($binary){

    }
}