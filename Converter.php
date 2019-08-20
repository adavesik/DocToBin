<?php


abstract class Converter
{
    abstract public function FileToBinary($fileName);
    abstract public function BinaryToFile($fileName);
    abstract public function Base64ToFile($inputfile, $outputfile);

    /**
     * @param $string
     * @return string
     */
    protected function stringToBinary($string)
    {
        $characters = str_split($string);

        $binary = [];
        foreach ($characters as $character) {
            $data = unpack('H*', $character);
            $binary[] = base_convert($data[1], 16, 2);
        }

        return implode(' ', $binary);
    }

    /**
     * @param $binary
     * @return string|null
     */
    protected function binaryToString($binary)
    {
        $binaries = explode(' ', $binary);

        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
        }

        return $string;
    }
}