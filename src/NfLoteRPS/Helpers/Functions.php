<?php

use Carbon\Carbon;
use MatheusHack\NfLoteRPS\Constants\FieldType;
use MatheusHack\NfLoteRPS\Exceptions\ValidateException;

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    if(!validateNumeric($date))
        return false;

    if(strlen($date) < 6)
        return true;
        
    $d = Carbon::createFromFormat($format, $date);
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

function treatText($text, $remove = null)
{
    $result = strtoupper(removeAccents(trim(html_entity_decode($text))));

    if($remove)
        $result = str_replace(str_split($remove), '', $result);

    return $result;
}

function convertFieldToType($value, $type, $amount = 1)
{
    switch($type){
        case FieldType::TEXT: 
        case FieldType::CHARACTER:
            $value = str_pad($value, $amount);
        break;
        case FieldType::WHITE:
            $value = str_pad('', $amount);
        break;        
        case FieldType::MONEY: 
        case FieldType::PERCENTAGE: 
            $money = str_replace(',', '', $value);
            $money = str_replace('.', '', $money);
            $value = str_pad($money, $amount, '0', STR_PAD_LEFT);
        break;
        case FieldType::DATE:
        case FieldType::NUMBER:
        case FieldType::DATETIME:
            $value = str_pad($value, $amount, '0', STR_PAD_LEFT);
        break;
    }

    $value = substr($value, 0, $amount);
    return $value;
}

function treatFieldToType($value, $type, $line = 0)
{
    try {
        switch ($type) {
            case FieldType::TEXT:
            case FieldType::CHARACTER:
            case FieldType::WHITE:
                $value = trim($value);
            break;
            case FieldType::MONEY:
            case FieldType::PERCENTAGE:
                $money = (int) trim(ltrim($value, '0'));
                $value = formatCurrency($money / 100);
            break;
            case FieldType::NUMBER:
                $value = (int) trim(ltrim($value, '0'));
            break;
            case FieldType::DATE:
                $date = trim(ltrim($value, '0'));
                if (empty($date))
                    return '';

                $year = substr($date, 0, 4);
                $month = substr($date, 4, 2);
                $day = substr($date, 6, 2);
                $value = Carbon::create($year, $month, $day)->format('Y-m-d');
            break;
            case FieldType::DATETIME:
                $date = trim(ltrim($value, '0'));

                if (empty($date))
                    return '';

                $year = substr($date, 0, 4);
                $month = substr($date, 4, 2);
                $day = substr($date, 6, 2);
                $hour = substr($date, 8, 2);
                $minute = substr($date, 10, 2);
                $second = substr($date, 12, 2);

                $value = Carbon::create($year, $month, $day, $hour, $minute, $second)->format('Y-m-d H:i:s');
            break;
        }
    }catch (Exception $e){
        return 'Error get value field';
    }

    return $value;
}

function removeAccents($string)
{
    return preg_replace([
            '/\xc3[\x80-\x85]/',
            '/\xc3\x87/',
            '/\xc3[\x88-\x8b]/',
            '/\xc3[\x8c-\x8f]/',
            '/\xc3([\x92-\x96]|\x98)/',
            '/\xc3[\x99-\x9c]/',

            '/\xc3[\xa0-\xa5]/',
            '/\xc3\xa7/',
            '/\xc3[\xa8-\xab]/',
            '/\xc3[\xac-\xaf]/',
            '/\xc3([\xb2-\xb6]|\xb8)/',
            '/\xc3[\xb9-\xbc]/',
        ],
        str_split('ACEIOUaceiou', 1),
        isUtf8($string) ? $string : utf8_encode($string)
    );
}

function isUtf8($string)
{
    return preg_match('%^(?:
        [\x09\x0A\x0D\x20-\x7E]
        | [\xC2-\xDF][\x80-\xBF]
        | \xE0[\xA0-\xBF][\x80-\xBF]
        | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}
        | \xED[\x80-\x9F][\x80-\xBF]
        | \xF0[\x90-\xBF][\x80-\xBF]{2}
        | [\xF1-\xF3][\x80-\xBF]{3}
        | \xF4[\x80-\x8F][\x80-\xBF]{2}
        )*$%xs',
        $string
    );
}

function validateFields(array $parameters, $value = '', $field = '', $amount = 1)
{
    switch($parameters['type']){
        default:
        case FieldType::TEXT: 
            $newValue = treatText($value);
        break;
        case FieldType::NOT_FILL:
            if(strlen($value) > $parameters['maximum'])
                throw new ValidateException("Maximum allowed size exceeded for {$field} field");

            $newValue = treatText($value);
        break;                    
        case FieldType::NUMBER: 
            if(!validateNumeric($value))
                throw new ValidateException("The default value of the {$field} field must be a number");
                
            $newValue = $value;
        break;
        case FieldType::DATE:
            if(!validateDate($value, 'Ymd'))
                throw new ValidateException("The default value of the {$field} field must be filled in the date format (YYYYMMDD)");

            $newValue = $value;
            break;
        case FieldType::DATETIME:
            if(!validateDate($value, 'YmdHis'))
                throw new ValidateException("The default value of the {$field} field must be filled in the date time format (YYYYMMDDHIS)");

            $newValue = $value;
        break;
        case FieldType::CHARACTER:
            if(!validateCharacter($value))
                throw new ValidateException("The default {$field} field value must be a character");

            $newValue = $value;
        break;
        case FieldType::ENDLINE:
            $newValue = chr(13).chr(10);
        break;

    }    

    return convertFieldToType($newValue, $parameters['type'], $amount);
}

function formatCurrency($str){
    $result = $str;

    if (is_numeric($str))
        $result = number_format($str, 2, ',', '.');

    return $result;
}