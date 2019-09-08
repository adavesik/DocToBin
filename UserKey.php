<?php
require_once "HelperClass.php";

class UserKey
{
    private $userkey;

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
            $i -= 48;
            if ($i>40)
            {
                $i -= 8;
            }

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