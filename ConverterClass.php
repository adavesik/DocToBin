<?php

require_once 'HelperClass.php';


class ConverterClass
{

    private $fileName;
    private $convertedDir;


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


    protected function read($file)
    {
        $fp = fopen($file, 'rb');

        while(($line = fgets($fp)) !== false)
            yield rtrim($line, "\r\n");

        fclose($fp);
    }

    public function FileToBinary($fileName)
    {
        $b64 = '';
        $chunkSize = 57 * 143;
        $src = fopen($fileName, 'rb');
        $dst = fopen('storage/converted/temp.txt', 'wb');
        while (!feof($src)) {
            $plain = fread($src, $chunkSize);
            $encoded = base64_encode($plain);
            $encoded = chunk_split($encoded, 76, "\r\n");
            fwrite($dst, $encoded);
        }
        fclose($dst);
        fclose($src);

/*        $image_data=file_get_contents($fileName);

        $encoded_image=base64_encode($image_data);
        file_put_contents($this->convertedDir."temp.txt", $encoded_image);*/

        //now we need to convert base64 string which is in temp.txt to binary file
        //get temp.txt file content
        //$b64content = file_get_contents($this->convertedDir."temp.txt");

        $src = fopen($this->convertedDir."temp.txt", 'rb');
        $dst = fopen($this->convertedDir."bindata.txt", 'wb');

        $buffer = $this->read($this->convertedDir."temp.txt");

        foreach ($buffer as $value) {
            $b64.= $value;
        }
        //echo $b64;
        //convert base64 to binary
        $bindata = HelperClass::stringToBinary($b64, false);
        fwrite($dst, $bindata);
        //file_put_contents($this->convertedDir."bindata.txt", $bindata, FILE_APPEND);
    }


    public function BinaryToBase64($fileName)
    {
        $b64 = '';

        /*        $image_data=file_get_contents($fileName);

                $encoded_image=base64_encode($image_data);
                file_put_contents($this->convertedDir."temp.txt", $encoded_image);*/

        //now we need to convert base64 string which is in temp.txt to binary file
        //get temp.txt file content
        //$b64content = file_get_contents($this->convertedDir."temp.txt");

        $src = fopen($this->convertedDir."bindata.txt", 'rb');
        $dst = fopen($this->convertedDir."final_base64.txt", 'wb');

        $buffer = $this->read($this->convertedDir."bindata.txt");

        foreach ($buffer as $value) {
            $b64.= $value;
        }
        //echo $b64;
        //convert base64 to binary
        $bindata = HelperClass::binaryToString($b64, false);
        fwrite($dst, $bindata);
        //file_put_contents($this->convertedDir."bindata.txt", $bindata, FILE_APPEND);
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