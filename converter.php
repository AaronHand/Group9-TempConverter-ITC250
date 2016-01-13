<?php

/**
 * Created by PhpStorm.
 * Users: Tom Karchesky, Jenn Lockett (?), Aaron Hand
 * Date: 1/12/16
 * Time: 5:10 PM
 * File: converter.php
 *
 * Description: Simple temperature conversion app that will convert
 * * to or from Celcius, Fahrenheit, or Kelvin.
 *
 */


define('THIS_PAGE',basename($_SERVER['PHP_SELF']));
$input = $_POST['user-input'];
$tempType = $_POST['temp'];
$submission = $_POST['submit'];


$checkForm = isset($submission) && is_numeric($input);


if($checkForm){
    echo "<pre>";
    echo convert($tempType,$input);
    echo "</pre>";

}else{
    echo '
    <form method="post" action="' . THIS_PAGE . '">

        <input type="text" name="user-input"><br>

        <label>Fahrenheit</label>
        <input type="radio" name="temp" value="Fahrenheit" checked><br>

        <label>Celcius</label>
        <input type="radio" name="temp" value="Celcius"><br>

        <label>Kelvin</label>
        <input type="radio" name="temp" value="Kelvin"><br>

        <input type="submit" name="submit" value="Convert!">
    </form>
    ';
}


/**
 * Switches on radio values
 * @param int $temp
 * @return null|string
 */

function convert($type,$temp=0)
{
    switch($type){

        case 'Fahrenheit':
            $degF = $temp;
            $degC = number_format(($temp - 32) * 5/9,2);
            $degK = number_format(($temp + 459.67) * 5/9,2);
            break;

        case 'Celcius':
            $degF = number_format($temp * 9/5 + 32,2);
            $degC = $temp;
            $degK = number_format($temp + 273.15,2);
            break;

        case 'Kelvin':
            $degF = number_format($temp * 9/5 -459.67,2);
            $degC = number_format($temp - 273.15,2);
            $degK = $temp;
            break;

        default:
            return "Erroneous Input.";
    }
    return "
        Fahrenheit: $degF
        Celcius:    $degC
        Kelvin:     $degK
    ";
}

