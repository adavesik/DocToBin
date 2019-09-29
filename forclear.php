<?php
$encoded = "JVBERi0xLjQKJeLjz9MKMSAwIG9iago8PC9UeXBlL0NhdGFsb2cvTWFya0luZm88PC9NYXJrZWQg";
$decoded = "";
for ($i=0; $i < ceil(strlen($encoded)/256); $i++)
    $decoded = $decoded . base64_decode(substr($encoded,$i*256,256));

echo $decoded;