<?php
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
        echo json_encode(['input_file'=>"/doctobin/storage/".basename($uploadfile), 'only_name'=>basename($uploadfile)]);
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
?>