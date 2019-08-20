<?php
require_once 'ImageClass.php';

$docFile = new ImageClass();

$docFile->setFileName("Energy.png");
$fileName = $docFile->getFileName();

$docFile->FileToBinary($fileName);
$docFile->BinaryToFile("bindata.txt");
$docFile->Base64ToFile('final_base64.txt', 'new_energy.png');