<?php


class XORClass
{
    const CHUNK_SIZE = 1048576;

    public function XorFiles($filename1, $filename2, $retbytes = TRUE){
        $file = new SplFileObject("storage/XOR_URS.txt", "w");

        $buffer = '';
        $cnt    = 0;
        $xored = '';
        $handle = fopen($filename1, 'rb');
        $handle_2 = fopen($filename2, 'rb');

        if ($handle === false) {
            return false;
        }

        while (!feof($handle) || !feof($handle_2)) {
            $buffer = fread($handle, self::CHUNK_SIZE);
            $buffer_2 = fread($handle_2, self::CHUNK_SIZE);

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
}