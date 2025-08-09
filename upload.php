<?php
// This file is part of the doctobin project.
// It handles the upload of a document, converts it to binary, and then back to a Word document.
$configs = include('config.php');

if(!empty($_FILES['file']['name'])){

    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);

    if(!in_array($file_extension, $configs['valid_extensions'])){
        die("Only doc files allowed");
    }

    /* Rename both the xsn file and the extension */
    $uploadfile = tempnam_sfx($configs['uploaddir'], ".doc");

    /* Upload the file to a secure directory with the new name and extension */
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {

        //read the doc file
        $n = basename($uploadfile);
        $cc =  file_get_contents("storage/$n");
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
        file_put_contents('final_base64.txt', $cb64);

        //convert base64 back to doc
        base64_to_doc('final_base64.txt', 'gen_word.doc');
        //echo "All files successfully generated!!!";

        echo json_encode(['input_file'=>"/doctobin/storage/".basename($uploadfile), 'only_name'=>basename($uploadfile), 'binary'=>"/doctobin/bindata.txt", 'tmp_b64'=>"/doctobin/temp.txt", 'back_b64'=>"/doctobin/final_base64.txt",
            'final_doc'=>"gen_word.doc"]);
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