<?php

require_once 'HelperClass.php';


class ConverterClass
{

    private $fileName;
    private $convertedDir;
    public $base64dir = "storage/base64/";

    public $space = true;


    public function __construct()
    {
    }


    /**
     * @param mixed $convertedDir
     */
    public function setConvertedDir($convertedDir)
    {
        $this->convertedDir = $convertedDir;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    public function FileToBinary($fileName)
    {
        $image_data = '';
        $bindata = '';
        $lines = file($fileName);

        foreach ($lines as $line){
            $bindata .= HelperClass::stringToBinary($line, $this->space);
            $image_data.=$line;
        }

        /*$image_data=file_get_contents($fileName);
        preg_split("/\R/", $image_data, -1, PREG_SPLIT_NO_EMPTY);*/

        //$encoded_image=base64_encode($image_data);
        file_put_contents($this->convertedDir."temp.txt", $image_data);

        //now we need to convert base64 string which is in temp.txt to binary file
        //get temp.txt file content
        //$b64content = file_get_contents($this->convertedDir."temp.txt");

        //convert base64 to binary


        file_put_contents($this->convertedDir."bindata.txt", $bindata);

    }

    public function BinaryToBase64($fileName)
    {

        //convert binary data into base64
        $data = file_get_contents($this->convertedDir.$fileName);

        $cb64 = HelperClass::bin2text($data, $this->space);

        $cb64 = rtrim($cb64);

        file_put_contents($this->convertedDir."final_base64.txt", $cb64);
    }

    public function Base64ToFile($inputfile, $outputfile)
    {

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



}