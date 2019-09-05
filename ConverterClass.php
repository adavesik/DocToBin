<?php

require_once 'HelperClass.php';
require_once 'BigFile.php';


class ConverterClass
{

    private $fileName;
    private $convertedDir;

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

        try {
            $largefile = new BigFile($fileName);
        } catch (Exception $e) {
        }

        $iterator = $largefile->iterate("Text"); // Text or Binary based on your file type

        foreach ($iterator as $line) {
            $bindata .= HelperClass::stringToBinary($line, $this->space);
            $image_data.=$line;
        }

        //uploaded file raw data just for a temporary file
        file_put_contents($this->convertedDir."temp.txt", $image_data);

        //save binary data
        file_put_contents($this->convertedDir."bindata.txt", $bindata);

    }


    public function BinCount($fileName){

        return HelperClass::getBinaryCharCount($fileName);
    }



    public function BinaryToFile($fileName)
    {
        //convert binary data into base64
        $data = file_get_contents($this->convertedDir.$fileName);

        $cb64 = HelperClass::bin2text($data, $this->space);

        $cb64 = rtrim($cb64);

        file_put_contents($this->convertedDir."back_file_raw.txt", $cb64);
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