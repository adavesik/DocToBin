<?php

class HelperClass
{
    public static function str_split_unicode($str, $l = 0) {
        if ($l > 0) {
            $ret = array();
            $len = mb_strlen($str, "UTF-8");
            for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($str, $i, $l, "UTF-8");
            }
            return $ret;
        }
        return preg_split("/\R/", $str, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function bin2text( $bin )
    {

        $text = '';
        # valid binary string, split, explode and other magic
        # prepare string for conversion
        $chars = explode( "\n", chunk_split( str_replace( "\n", '', $bin ), 8 ) );
        $char_count = count( $chars );

        # converting the characters one by one
        for( $i = 0; $i < $char_count; $text .= chr( bindec( $chars[$i] ) ), $i++ );

        # let's return the result
        return $text;

    }

    public static function getBinaryCharCount($filename){

        $string = file_get_contents($filename);

        $characters = HelperClass::str_split_unicode($string, 1);
        return sizeof($characters);
    }

    ///TODO: Implement this function to fill up binary data
    public static function fillUpBinaryData($filename){
        // This function should read the file and fill up binary data as needed.
        // For now, it is just a placeholder.
        // You can implement the logic to read the file and process it as per your requirements.
        // For example, you might want to read the file in chunks and convert it to binary
        // or perform some other operations based on your application's needs.
        // This is a stub function and does not perform any operations currently.
        // You can remove this comment and implement the logic as needed.
        // Example:
        // $fileContent = file_get_contents($filename);
        // $binaryData = self::stringToBinary($fileContent);
        // return $binaryData;
        // Note: Make sure to handle any exceptions or errors that may occur during file operations.
        // This is just a placeholder function and does not perform any operations currently.
        // You can remove this comment and implement the logic as needed.
        // Example:
        // $fileContent = file_get_contents($filename);
        // $binaryData = self::stringToBinary($fileContent);
        // return $binaryData;
        // Note: Make sure to handle any exceptions or errors that may occur during file operations.
        // This is just a placeholder function and does not perform any operations currently.
        // You can remove this comment and implement the logic as needed.
        // Example:
        // $fileContent = file_get_contents($filename);
        // $binaryData = self::stringToBinary($fileContent);
        // return $binaryData;
        // Note: Make sure to handle any exceptions or errors that may occur during file operations.
        // This is just a placeholder function and does not perform any operations currently.
        // You can remove this comment and implement the logic as needed.
        // Example:
        // $fileContent = file_get_contents($filename);
        // $binaryData = self::stringToBinary($fileContent);
        // return $binaryData;
        // Note: Make sure to handle any exceptions or errors that may occur during file operations.
        // This is just a placeholder function and does not perform any operations currently.
        // You can remove this comment and implement the logic as needed.
        // Example:
        // $fileContent = file_get_contents($filename);
        // $binaryData = self::stringToBinary($fileContent);
        // return $binaryData;
        // Note: Make sure to handle any exceptions or errors that may occur during file operations.
        // This is just a placeholder function and does not perform any operations currently.               
    }

    /**
     * @param $string
     * @return string
     */
    public static function stringToBinary($string, $space = true)
    {
        $characters = HelperClass::str_split_unicode($string, 1);

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

            $un_trimmed = chunk_split($binary, 8, ' ');
            $trimmed = rtrim($un_trimmed);

            $binaries = substr($trimmed,0);
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


    public function fillUpBinaryData($filename){

    }

    public static function getBinaryCharCount($filename){

        $string = file_get_contents($filename);

        $characters = HelperClass::str_split_unicode($string, 1);
        return sizeof($characters);
    }
}