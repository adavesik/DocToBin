<?php
require_once 'DocClass.php';

$docFile = new DocClass();

$docFile->setFileName("WordExample.doc");
$fileName = $docFile->getFileName();

$docFile->FileToBinary($fileName);