<?php
$configs = include('config.php');
require_once 'ImageClass.php';
require_once 'DocClass.php';



if(!empty($_FILES['file']['name'])){

    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);

    switch ($file_extension){
        case "doc":
        case "docx":
        $docFile = new DocClass();
            break;
        case "jpeg":
        case "png":
        $docFile = new ImageClass();
        break;

        default:
            break;
    }

    if(!in_array($file_extension, $configs['valid_extensions'])){
        die("Only doc files allowed");
    }

    /* Rename both the xsn file and the extension */
    $uploadfile = tempnam_sfx($configs['uploaddir'], ".".$file_extension);

    /* Upload the file to a secure directory with the new name and extension */
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

        //read the doc file
        $n = basename($uploadfile);

        $docFile->setFileName("storage/$n");
        $fileName = $docFile->getFileName();

        $docFile->FileToBinary($fileName);
        $docFile->BinaryToFile("bindata.txt");
        $docFile->Base64ToFile('final_base64.txt', 'gen_'.$n);

        echo json_encode(['input_file'=>"/doctobin/storage/".basename($uploadfile), 'only_name'=>basename($uploadfile), 'binary'=>"/doctobin/bindata.txt", 'tmp_b64'=>"/doctobin/temp.txt", 'back_b64'=>"/doctobin/final_base64.txt",
            'final_doc'=>"gen_".$n]);
    }
    else {
        echo "err";
        die("Doc upload failed!");
    }
}


/* Generates random filename and extension */
function tempnam_sfx($path, $suffix){

    if(!is_dir($path)){
        mkdir($path, 0777, true);
    }

    do {
        $file = $path . DIRECTORY_SEPARATOR . mt_rand () . $suffix;
    } while (file_exists($file));

    return $file;
}





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
?>