<?php

/**
 * Created by PhpStorm.
 * Users: Tom Karchesky, Jenn Lockett (?), Aaron Hand
 * Date: 1/12/16
 * Time: 5:10 PM
 * File: converter.php
 *
 * Description: Simple temperature conversion app that will convert
 * * to or from Celsius, Fahrenheit, or Kelvin.
 *
 * TODO: Error handling, styles.
 *
 */


define('THIS_PAGE',basename($_SERVER['PHP_SELF']));




if(isset($_POST['submit']) && is_numeric($_POST['user-input'])){
    $input = $_POST['user-input'];
    $type = $_POST['type'];


    echo "<pre>";
    echo convert();
    echo "</pre>";

}else{
    echo '
    <form method="post" action="' . THIS_PAGE . '">

        <input type="text" name="user-input"><br>

        <label>Fahrenheit</label>
        <input type="radio" name="type" value="Fahrenheit" checked><br>

        <label>Celsius</label>
        <input type="radio" name="type" value="Celsius"><br>

        <label>Kelvin</label>
        <input type="radio" name="type" value="Kelvin"><br>

        <input type="submit" name="submit" value="Convert!">
    </form>
    ';
}


/**
 * Switches on radio values
 * @param $type
 * @param int $temp
 * @return null|string
 */

function convert()
{
    global $type,$input;
    switch($type){

        case 'Fahrenheit':
            $degF = $input;
            $degC = number_format(($input - 32) * 5/9,2);
            $degK = number_format(($input + 459.67) * 5/9,2);
            break;

        case 'Celsius':
            $degF = number_format($input * 9/5 + 32,2);
            $degC = $input;
            $degK = number_format($input + 273.15,2);
            break;

        case 'Kelvin':
            $degF = number_format($input * 9/5 -459.67,2);
            $degC = number_format($input - 273.15,2);
            $degK = $input;
            break;

        default:
            return "Erroneous Input.";
    }
    return "
        Fahrenheit: $degF
        Celsius:    $degC
        Kelvin:     $degK
    ";
}

