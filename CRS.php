<?php


class CRS
{

    private $strandsDir;


    function setStrandsDir($path){
        $this->strandsDir  =   $path;
    }

    /**
     * @param $dir
     * @param $regex
     * @return array
     */
    function getStrandsList($regex)
    {
        $retval = [];

        // add trailing slash if missing
        if(substr($this->strandsDir, -1) != "/") $this->strandsDir .= "/";

        // open directory for reading
        $d = new DirectoryIterator($this->strandsDir) or die("getFilteredFileList: Failed opening directory $this->strandsDir for reading");
        $iterator = new RegexIterator($d, $regex, RegexIterator::MATCH);
        foreach($iterator as $fileinfo) {
            // skip hidden files
            if($fileinfo->isDot()) continue;
            $retval[] = [
                'name' => "{$this->strandsDir}{$fileinfo}",
                'type' => ($fileinfo->getType() == "dir") ? "dir" : mime_content_type($fileinfo->getRealPath()),
                'size' => $fileinfo->getSize(),
                'lastmod' => $fileinfo->getMTime()
            ];
        }

        return $retval;
    }


    /**
     * @param $filename
     * @param $offset
     * @param bool $retbytes
     * @return bool|string
     */
    public function getEvery184Bits($filename, $offset, $retbytes = true){
        $buffer = '';
        $cnt    = 0;
        $handle = fopen($filename, 'rb');

        if ($handle === false) {
            return false;
        }

        // Jump to last character
        fseek($handle, $offset*184);

        $buffer = fread($handle, 184);

        ob_flush();
        flush();

        if ($retbytes) {
            $cnt += strlen($buffer);
        }

        $status = fclose($handle);

        if ($retbytes && $status) {
            return $buffer; // return num. bytes delivered like readfile() does.
        }

        return $status;
    }


    /**
     * @param $string
     * @return array
     */
    protected function splitInto23Bit($string){

        $buffer = str_split($string, 23);

        return $buffer;
    }


    /**
     * @param $string
     * @return array|float|int
     */
    function getRearrangingPoints($string){
        $points = array();

        $bindata = $this->splitInto23Bit($string);

        foreach ($bindata as $bindatum) {
            $points[] = bindec($bindatum);
        }

        return $points;
    }


    public function rearrangeManyFiles($filename0, $filename1, $filename2, $filename3, $filename4, $filename5, $filename6, $filename7, $step, $points){

        $status = $this->rearrangeFile($filename0, str_replace("/", "R"."P", substr($filename0, 4, strlen($filename0))), $points[0]);
        $status = $this->rearrangeFile($filename1, str_replace("/", "R"."P", substr($filename1, 4, strlen($filename0))), $points[1]);
        $status = $this->rearrangeFile($filename2, str_replace("/", "R"."P", substr($filename2, 4, strlen($filename0))), $points[2]);
        $status = $this->rearrangeFile($filename3, str_replace("/", "R"."P", substr($filename3, 4, strlen($filename0))), $points[3]);
        $status = $this->rearrangeFile($filename4, str_replace("/", "R"."P", substr($filename4, 4, strlen($filename0))), $points[4]);
        $status = $this->rearrangeFile($filename5, str_replace("/", "R"."P", substr($filename5, 4, strlen($filename0))), $points[5]);
        $status = $this->rearrangeFile($filename6, str_replace("/", "R"."P", substr($filename6, 4, strlen($filename0))), $points[6]);
        $status = $this->rearrangeFile($filename7, str_replace("/", "R"."P", substr($filename7, 4, strlen($filename0))), $points[7]);

        return $points;
    }



    protected function rearrangeFile($filename, $origname, $point){

        $fname = substr(strrchr($filename, "/"), 1);
        $handle = fopen($filename, 'rb');

        if ($handle === false) {
            return false;
        }

        $buffer = fread($handle, filesize($filename));

        $start_bits = substr($buffer, 0, $point);
        $end_bits = substr($buffer, $point, strlen($buffer));
        $new_strand = $end_bits.$start_bits;

        $file = new SplFileObject("crs/rearranged_strands/$origname", "w");
        $written = $file->fwrite($new_strand);

        ob_flush();
        flush();

        $status = fclose($handle);

        return $status;
    }

}