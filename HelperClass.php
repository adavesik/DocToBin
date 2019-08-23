<?php


class HelperClass
{
    /**
     * @param $string
     * @return string
     */
    public static function stringToBinary($string)
    {
        $characters = str_split($string);

        $binary = [];
        foreach ($characters as $character) {
            $data = unpack('H*', $character);
            $binary[] = base_convert($data[1], 16, 2);
        }

        return implode('', $binary);
    }

    /**
     * @param $binary
     * @return string|null
     */
    public static function binaryToString($binary)
    {
        $binaries = explode(' ', $binary);

        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
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
}