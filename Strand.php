<?php
require_once "UserKey.php";

class Strand
{


    public function rearrangeStrands($filename0, $filename1, $filename2, $filename3, $filename4, $filename5, $filename6, $filename7){
        $all_bits = UserKey::get184Bits("storage/userkey.txt");

        $points_str = chunk_split($all_bits, 23, ' ');
        $points = substr(rtrim($points_str),0);
        $points = explode(' ', $points);

        $point0 = bindec($points[0]);
        $point1 = bindec($points[1]);
        $point2 = bindec($points[2]);
        $point3 = bindec($points[3]);
        $point4 = bindec($points[4]);
        $point5 = bindec($points[5]);
        $point6 = bindec($points[6]);
        $point7 = bindec($points[7]);

        $status = $this->rearrangeFile($filename0, "0-2019-08-03.txt", $point0);
        $status = $this->rearrangeFile($filename1, "1-2018-10-17.txt", $point1);
        $status = $this->rearrangeFile($filename2, "2-2018-09-28.txt", $point2);
        $status = $this->rearrangeFile($filename3, "3-2019-09-02.txt", $point3);
        $status = $this->rearrangeFile($filename4, "4-2019-02-05.txt", $point4);
        $status = $this->rearrangeFile($filename5, "5-2018-12-22.txt", $point5);
        $status = $this->rearrangeFile($filename6, "6-2019-01-06.txt", $point6);
        $status = $this->rearrangeFile($filename7, "7-2019-03-14.txt", $point7);

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

        $file = new SplFileObject("strands/rearranged/$origname", "w");
        $written = $file->fwrite($new_strand);

        ob_flush();
        flush();

        $status = fclose($handle);

        return $status;
    }

}