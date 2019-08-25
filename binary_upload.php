<?php

$configs = include('config.php');
require_once 'ConverterClass.php';
require_once 'UploaderClass.php';

$docFile = new ConverterClass();
$uploader = new UploaderClass();

$uploader->setDir($configs['uploaddir']);
//$uploader->allowAllFormats();
$uploader->setExtensions(array('txt'));                    //allowed extensions list
$uploader->setMaxSize(90);                         //set max file size to be allowed in MB//

$fileExtension = $_POST['ext'];
if(empty($fileExtension))
{
    $fileExtension = '.data';
}

if($uploader->uploadFile('binaryfile')){         //txtFile is the filebrowse element name //
    $document  =   $uploader->getUploadName();             //get uploaded file name, renames on upload//

    $docFile->setConvertedDir('storage/');
    $docFile->setFileName("storage/$document");
    $docFile->space = false;
    $fileName = $docFile->getFileName();

    //var_dump($fileName);
    //$docFile->FileToBinary($fileName);
    $docFile->BinaryToBase64(basename($fileName));
    $docFile->Base64ToFile('storage/final_base64.txt', 'storage/converted/generatedFile'.$fileExtension);

    echo json_encode(['input_file'=>"/doc2bin/storage/".$document, 'only_name'=>$document, 'binary'=>"/doc2bin/storage/converted/bindata.txt", 'tmp_b64'=>"/doc2bin/storage/converted/temp.txt", 'back_b64'=>"/doc2bin/storage/converted/final_base64.txt",
        'final_doc'=>"/doc2bin/storage/converted/generatedFile".$fileExtension]);


}else{//upload failed
    echo json_encode($uploader->getMessage()); //get upload error message
}

?>