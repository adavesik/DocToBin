<?php
require 'Converter.php';

class ImageClass extends Converter
{
    private $fileName;

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

    public function Base64ToFile($inputfile, $outputfile)
    {
        //convert binary data into base64
        $data = file_get_contents("bindata.txt");
        $cb64 = Converter::binaryToString($data);
        file_put_contents('final_base64.txt', $cb64);

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

    public function BinaryToFile($fileName)
    {

        //convert binary data into base64
        $data = file_get_contents("bindata.txt");
        $cb64 = Converter::binaryToString($data);
        file_put_contents('final_base64.txt', $cb64);
    }

    public function FileToBinary($fileName)
    {
        $image_data=file_get_contents($fileName);

        $encoded_image=base64_encode($image_data);
        file_put_contents('temp.txt', $encoded_image);

        //now we need to convert base64 string which is in temp.txt to binary file
        //get temp.txt file content
        $b64content = file_get_contents('temp.txt');

        //convert base64 to binary
        $bindata = Converter::stringToBinary($b64content);
        file_put_contents('bindata.txt', $bindata);
    }

}