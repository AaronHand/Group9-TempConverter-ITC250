<?php
/**
 * Created by PhpStorm.
 * Users:
 * Date: 1/12/16
 * Time: 5:10 PM
 */


define('THIS_PAGE',basename($_SERVER['PHP_SELF']));


if(isset($_POST['submit']) && is_numeric($_POST['user-input']))
{
    echo "<pre>";
    echo convert($_POST['user-input']);
    echo "</pre>";


}else{
    echo '
    <form method="post" action="' . THIS_PAGE . '">
        <input type="text" name="user-input"><br>
        <label>Fahrenheit </label><input type="radio" name="temp" value="Fahrenheit" checked><br>
        <label>Celcius </label><input type="radio" name="temp" value="Celcius"><br>
        <label>Kelvin </label><input type="radio" name="temp" value="Kelvin"><br>
        <input type="submit" name="submit" value="Convert!">
    </form>
    ';
}


/**
 * @param int $temp
 * @return null|string
 */

function convert($temp=0){
    switch($_POST['temp']){
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
            return null;
    }
    return "
        Fahrenheit: $degF
        Celcius:    $degC
        Kelvin:     $degK
    ";
}


