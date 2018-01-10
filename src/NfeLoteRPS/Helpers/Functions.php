<?php

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}  

function validateNumeric($number)
{ 
    if(is_numeric($number))
        return true;

    return false;
} 

function validateCharacter($character)
{
    if(strlen($character) == 1)
        return true;

    return false;
}