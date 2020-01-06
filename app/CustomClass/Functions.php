<?php
namespace App\CustomClass;

class Functions
{
    public static function  serialize_to_base64($array)
    {
        $salt = 'TYoiu78GH54DFcf';
        $serialized_array = $salt . base64_encode(serialize($array));
        return $serialized_array = base64_encode($serialized_array);
    }

    public static function unserialize_from_base64($base64)
    {
        $salt = 'TYoiu78GH54DFcf';
        $array = str_replace($salt, '', base64_decode($base64)) ;
        return $array = unserialize(base64_decode($array));
    }
}