<?php


class XORClass
{
    const CHUNK_SIZE = 1048576;
    //const CHUNK_SIZE = 1024;

    public function XorFiles($filename1, $filename2, $method, $output = "storage/XORed_UserKey.txt", $retbytes = TRUE){
        $file = new SplFileObject($output, "w");

        $buffer = '';
        $cnt    = 0;
        $xored = '';
        $handle = fopen($filename1, 'rb');
        $handle_2 = fopen($filename2, 'rb');

        if ($handle === false) {
            return false;
        }

            if($method == 1){
                while (!feof($handle) || !feof($handle_2)) {
                    $buffer = fread($handle, self::CHUNK_SIZE);
                    $buffer_2 = fread($handle_2, self::CHUNK_SIZE);

                    if (!empty($buffer)) {
                        $bin_1 = str_split($buffer);
                        $bin_2 = str_split($buffer_2);

                        foreach ($bin_1 as $key => $value) {
                            $xored .= (int)$value ^ (int)$bin_2[$key];
                        }

                        $written = $file->fwrite($xored);
                        $xored = '';
                        //echo $buffer;
                        ob_flush();
                        flush();

                        if ($retbytes) {
                            $cnt += strlen($buffer_2);
                        }
                    }
                }
            }

            if($method == 0){
                while (!feof($handle) || !feof($handle_2)) {
                    $buffer = fread($handle, self::CHUNK_SIZE);
                    $buffer_2 = fread($handle_2, self::CHUNK_SIZE);

                    if (!empty($buffer)) {
                        $bin_1 = str_split($buffer);
                        $bin_2 = str_split($buffer_2);

                        foreach ($bin_1 as $key => $value) {
                            $xored .= $this->xnor((int)$value, (int)$bin_2[$key]);
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
    public function xnor(...$inputs): int
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



}