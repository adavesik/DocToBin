<?php
require_once 'BigFile.php';

class Urs
{
    public function makeURS($strand_0, $strand_1, $strand_2, $strand_3, $strand_4, $strand_5, $strand_6, $strand_7){

        $file = new SplFileObject("storage/URS.txt", "w");

        $handle_0 = fopen($strand_0, 'rb');
        $handle_1 = fopen($strand_1, 'rb');
        $handle_2 = fopen($strand_2, 'rb');
        $handle_3 = fopen($strand_3, 'rb');
        $handle_4 = fopen($strand_4, 'rb');
        $handle_5 = fopen($strand_5, 'rb');
        $handle_6 = fopen($strand_6, 'rb');
        $handle_7 = fopen($strand_7, 'rb');

        if ($handle_0 === false || $handle_1 === false || $handle_2 === false || $handle_3 === false || $handle_4 === false) {
            return false;
        }

        while (!feof($handle_0) || !feof($handle_1) || !feof($handle_2) || !feof($handle_3) || !feof($handle_4) || !feof($handle_5)) {
            $buffer_0 = fgets($handle_0);
            $buffer_1 = fgets($handle_1);
            $buffer_2 = fgets($handle_2);
            $buffer_3 = fgets($handle_3);
            $buffer_4 = fgets($handle_4);
            $buffer_5 = fgets($handle_5);
            $buffer_6 = fgets($handle_6);
            $buffer_7 = fgets($handle_7);

            $written = $file->fwrite($buffer_0.$buffer_1.$buffer_2.$buffer_3.$buffer_4.$buffer_5.$buffer_6.$buffer_7);
            ob_flush();
            flush();
        }

        $status = fclose($handle_0);
        fclose($handle_1);
        fclose($handle_2);
        fclose($handle_3);
        fclose($handle_4);
        fclose($handle_5);
        fclose($handle_6);
        fclose($handle_7);

        return $status;
    }

}