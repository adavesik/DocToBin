<?php
require_once "HelperClass.php";

class UserKey
{
    private $userkey;

    private $encodingTable = array(
        "0"=>0,
        "1"=>1,
        "2"=>2,
        "3"=>3,
        "4"=>4,
        "5"=>5,
        "6"=>6,
        "7"=>7,
        "8"=>8,
        "9"=>9,
        "A"=>10,
        "B"=>11,
        "C"=>12,
        "D"=>13,
        "E"=>14,
        "F"=>15,
        "G"=>16,
        "H"=>17,
        "I"=>18,
        "J"=>19,
        "K"=>20,
        "L"=>21,
        "M"=>22,
        "N"=>23,
        "O"=>24,
        "P"=>25,
        "Q"=>26,
        "R"=>27,
        "S"=>28,
        "T"=>29,
        "U"=>30,
        "V"=>31,
        "W"=>32,
        "X"=>33,
        "Y"=>34,
        "Z"=>35,
        "a"=>36,
        "b"=>37,
        "c"=>38,
        "d"=>39,
        "e"=>40,
        "f"=>41,
        "g"=>42,
        "h"=>43,
        "i"=>44,
        "j"=>45,
        "k"=>46,
        "l"=>47,
        "m"=>48,
        "n"=>49,
        "o"=>50,
        "p"=>51,
        "q"=>52,
        "r"=>53,
        "s"=>54,
        "t"=>55,
        "u"=>56,
        "v"=>57,
        "w"=>58,
        "x"=>59,
        "y"=>60,
        "z"=>61,
        "+"=>62,
        "/"=>63,
    );


    public function __construct($userkey)
    {
        $this->setUserkey($userkey);
    }

    /**
     * @param mixed $userkey
     */
    protected function setUserkey($userkey)
    {
        if (FALSE === $this->validateUserKey($userkey)) {
            throw new InvalidArgumentException(
                '$userkey should consists of english letters and digits and plus sign and / symbol'
            );
        }
        $this->userkey = $userkey;
    }


    public function getUserKey(){

        return $this->userkey;
    }


    protected function validateUserKey($userkey){

        return (!preg_match('/[^A-Za-z\+\/\d]+/', $userkey) ? true : false);
    }


    public function convertToBinary($userkey){

        $stringLen = 6;

        $characters = HelperClass::str_split_unicode($userkey, 1);

        $binary = [];
        foreach ($characters as $character) {
            $i = ord($character);

            if($i > 48){
                $i -= 48;
            }

            while ($i>63)
            {
                $i -= 8;
            }

            var_dump($i);
            $sixBit = decbin($i);

            // hardcoded left padding if number < $str_length
            $sixBit = substr("000".$sixBit, -$stringLen);
            $binary[] = $sixBit;
        }
        return $binary;


    }


    protected function expandUserKey($userkey){

    }

}