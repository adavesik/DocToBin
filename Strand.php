<?php
require_once "UserKey.php";

class Strand
{


    public function rearrangeStrands($filename0, $filename1, $filename2, $filename3, $filename4, $filename5, $filename6, $filename7){
/*        $all_bits = UserKey::get184Bits("storage/userkey.txt");

        $points_str = chunk_split($all_bits, 23, ' ');
        $points = substr(rtrim($points_str),0);
        $points = explode(' ', $points);*/

        $point0 = bindec(UserKey::getLast23Bits("uks/Exp Key 0.txt"));
        $point1 = bindec(UserKey::getLast23Bits("uks/Exp Key 1.txt"));
        $point2 = bindec(UserKey::getLast23Bits("uks/Exp Key 2.txt"));
        $point3 = bindec(UserKey::getLast23Bits("uks/Exp Key 3.txt"));
        $point4 = bindec(UserKey::getLast23Bits("uks/Exp Key 4.txt"));
        $point5 = bindec(UserKey::getLast23Bits("uks/Exp Key 5.txt"));
        $point6 = bindec(UserKey::getLast23Bits("uks/Exp Key 6.txt"));
        $point7 = bindec(UserKey::getLast23Bits("uks/Exp Key 7.txt"));

        $status = $this->rearrangeFile($filename0, "0-KeyRandomizedRearranged.txt", $point0);
        $status = $this->rearrangeFile($filename1, "1-KeyRandomizedRearranged.txt", $point1);
        $status = $this->rearrangeFile($filename2, "2-KeyRandomizedRearranged.txt", $point2);
        $status = $this->rearrangeFile($filename3, "3-KeyRandomizedRearranged.txt", $point3);
        $status = $this->rearrangeFile($filename4, "4-KeyRandomizedRearranged.txt", $point4);
        $status = $this->rearrangeFile($filename5, "5-KeyRandomizedRearranged.txt", $point5);
        $status = $this->rearrangeFile($filename6, "6-KeyRandomizedRearranged.txt", $point6);
        $status = $this->rearrangeFile($filename7, "7-KeyRandomizedRearranged.txt", $point7);

        $points[] = $point0;
        $points[] = $point1;
        $points[] = $point2;
        $points[] = $point3;
        $points[] = $point4;
        $points[] = $point5;
        $points[] = $point6;
        $points[] = $point7;

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