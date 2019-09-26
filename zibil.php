<?php
$start_time = microtime(true);

require_once "BigFile.php";
require_once "UserKey.php";
require_once "HelperClass.php";
require_once "Urs.php";
require_once "Strand.php";

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


function binaryToString($binary, $is_spaced = false)
{
    if(!$is_spaced){

        $un_trimmed = chunk_split($binary, 8, ' ');
        $trimmed = rtrim($un_trimmed);

        $binaries = substr($trimmed,0);
        $binaries = explode(' ', $binaries);
    }
    else{
        $binaries = explode(' ', $binary);
    }

    $string = null;
    foreach ($binaries as $bin) {
        $string .= pack('H*', base_convert($bin, 2, 16));
    }

    return $string;
}



function bin2text( $bin )
{

    $text = '';
        # valid binary string, split, explode and other magic
        # prepare string for conversion
        $chars = explode( "\n", chunk_split( str_replace( "\n", '', $bin ), 8 ) );
        $char_count = count( $chars );

        # converting the characters one by one
        for( $i = 0; $i < $char_count; $text .= chr( bindec( $chars[$i] ) ), $i++ );

        # let's return the result
        return "Result: " . $text;

}

//echo stringToBinary("sevada");

$binary = "00100101010100000100010001000110110010";

$un_trimmed = chunk_split($binary, 8, ' ');
$trimmed = rtrim($un_trimmed);

//var_dump($trimmed);

$binaries = substr($trimmed,0);
$binaries = explode(' ', $binaries);

//var_dump($binaries);

/*foreach ($binaries as $bin) {
    echo "Binary is: ".$bin;
    echo "<pre>";
    echo "Base convert is: ".base_convert($bin, 2, 16);
    echo "<pre>";
    echo "Ascii is: ".pack('H*', base_convert($bin, 2, 16));
    echo "<pre><hr>";

}*/


echo "<pre>";
//echo pack('H*', '2e');
//echo "Encoded is: ".bin2text($binary);



/*$largefile_1 = new BigFile("strands/0-2019-08-03.txt");
$largefile_2 = new BigFile("strands/1-2018-10-17.txt");

$iterator_1 = $largefile_1->iterate("Text"); // Text or Binary based on your file type
$iterator_2 = $largefile_2->iterate("Text"); // Text or Binary based on your file type

foreach ($iterator_1 as $line_1) {
    //echo $line_1;
    //$characters = HelperClass::str_split_unicode($line_1, 1);
}*/

/*$file = new SplFileObject("storage/USR4.txt", "w");
$file_1 = fopen("strands/0-2019-08-03.txt","r");
$file_2 = fopen("strands/1-2018-10-17.txt","r");
$xored = '';

while (! feof($file_1) || !feof($file_2)) {
    $xored .= (int)fgetc($file_1) ^ (int)fgetc($file_2);
    //echo $xored;
}
$written = $file->fwrite($xored);
fclose($file_1);
fclose($file_2);*/



$uk = new UserKey("SEVADA");
/*$key = $uk->getUserKey();
echo $key."<pre>";
print_r($uk->convertToBinary($key));
$userkey = $uk->convertToBinary($key);*/

//$uk->expandUserKey($userkey);

/*$n = (pow(2, 26) - pow(2, 26) % 18) / 18;
$remained =  pow(2, 26) - 18*$n;
$remained_bits = substr($userkey, 0, $remained);

$file = new SplFileObject("storage/userkey.txt", "w");

$exp_userkey = str_repeat($userkey, $n);
$written = $file->fwrite($exp_userkey);
echo "Wrote $written bytes to file";
echo "<pre>";
$written = $file->fwrite($remained_bits);
echo "Wrote $written bytes to file";

echo $remained;*/

function step1() {
    $file = new SplFileObject("storage/USR4.txt", "w");
    $file_1 = fopen("strands/0-2019-08-03.txt","r");
    $file_2 = fopen("strands/1-2018-10-17.txt","r");
    $xored = '';

    while (! feof($file_1) || !feof($file_2)) {
        $xored .= (int)fgetc($file_1) ^ (int)fgetc($file_2);
        yield true;
    }
    $written = $file->fwrite($xored);
    fclose($file_1);
    fclose($file_2);
}
function step2() {
    $file = new SplFileObject("storage/USR5.txt", "w");
    $file_1 = fopen("strands/2-2018-09-28.txt","r");
    $file_2 = fopen("strands/3-2019-09-02.txt","r");
    $xored = '';

    while (! feof($file_1) || !feof($file_2)) {
        $xored .= (int)fgetc($file_1) ^ (int)fgetc($file_2);
        yield true;
    }
    $written = $file->fwrite($xored);
    fclose($file_1);
    fclose($file_2);
}


function runner(array $steps) {
    while (true) {                                                # снова бесконечный цикл, в котором перебираем потоки
        foreach ($steps as $key => $step) {
            $step->next();                                    # возобновляем работу потока с с момента последнего yield
            if (!$step->valid()) {                           # проверяем, завершился ли поток и завершаем (удаляем) его
                unset($steps[$key]);
            }
        }
        if (empty($steps)) return;                      # если потоков нет - завершаем работу
    }
}

//runner(array(step1(), step2()));





define('CHUNK_SIZE', 1024*1024); // Size (in bytes) of tiles chunk

// Read a file and display its content chunk by chunk
function readfile_chunked($filename, $second_filename, $retbytes = TRUE) {
    $file = new SplFileObject("storage/USR4.txt", "w");

    $buffer = '';
    $cnt    = 0;
    $xored = '';
    $handle = fopen($filename, 'rb');
    $handle_2 = fopen($second_filename, 'rb');

    if ($handle === false) {
        return false;
    }

    while (!feof($handle) || !feof($handle_2)) {
        $buffer = fread($handle, CHUNK_SIZE);
        $buffer_2 = fread($handle_2, CHUNK_SIZE);

        $bin_1 = str_split($buffer);
        $bin_2 = str_split($buffer_2);

        foreach ($bin_1 as $key=>$value){
            $xored .= (int)$value ^ (int)$bin_2[$key];
        }

        $written = $file->fwrite($xored);
        $xored = '';
        //echo $buffer;
        ob_flush();
        flush();

        if ($retbytes) {
            $cnt += strlen($buffer);
        }
    }

    fclose($handle_2);
    $status = fclose($handle);

    if ($retbytes && $status) {
        return $cnt; // return num. bytes delivered like readfile() does.
    }

    return $status;
}


/**
 * Runs the XNOR gate function on the given numbers.
 * Each input will be cast to a boolean before comparing.
 *
 * @param mixed ...$inputs
 *
 * @return bool
 */
function xnor(...$inputs): int
{
    if (!$inputs) {
        throw new InvalidArgumentException('At least one input must be provided.');
    }
    $compare = (bool)array_shift($inputs);
    foreach ($inputs as $input) {
        if ((bool)$input !== $compare) {
            return 0;
        }
    }
    return 1;
}


//readfile_chunked("strands/2-2018-09-28.txt","strands/3-2019-09-02.txt");

//echo $uk->splitIntoEight("storage/userkey.txt");

/*$urs = new Urs();
$urs->makeURS("strands/0-2019-08-03.txt", "strands/1-2018-10-17.txt", "strands/2-2018-09-28.txt",
              "strands/3-2019-09-02.txt", "strands/4-2019-02-05.txt", "strands/5-2018-12-22.txt",
              "strands/6-2019-01-06.txt", "strands/7-2019-03-14.txt");*/


//$uk = new UserKey("CAT");
//$bts = $uk->get23Bits("storage/userkey.txt", 2);

$bts = UserKey::getLast24Bit("storage/userkey.txt");

echo $bts;
echo "<br>";

//echo bindec($bts);
echo "<br>";


$strand = new Strand();
//echo $strand->rearrangeStrands();

//echo xnor(0, 0);




// End clock time in seconds
$end_time = microtime(true);

// Calculate script execution time
$execution_time = ($end_time - $start_time);

echo " Execution time of script = ".$execution_time." sec";