<?php

/**
 * Created by PhpStorm.
 * Users: Tom Karchesky, Jen Lockett , Aaron Hand
 * Date: 1/12/16
 * Time: 5:10 PM
 * File: converter.php
 *
 * Description: Simple temperature conversion app that will convert
 * * to or from Celsius, Fahrenheit, or Kelvin.
 *
 * TODO: Error handling, styles, redo the error message, visual display function - handle dumping form + append.
 *
 */


define('THIS_PAGE',basename($_SERVER['PHP_SELF']));

$form = '
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

$formIsSet = isset($_POST['submit']);


/**
 *
 * there should probably be a checkForm() function, this is a little sloppy.
 *
 */


if($formIsSet){
    $input = $_POST['user-input'];
    $type = $_POST['type'];
    if(is_numeric($_POST['user-input'])) {
        echo "<pre>";
        echo convert();
        echo "</pre>";
    }else {
        $form .= '<h4>Erroneous Input, Please Resubmit.</h4>';
        echo $form;
    }

}else{
    echo $form;
}


/**
 * Switches on radio values
 * @return null|string
 * @internal param $type
 * @internal param int $temp
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

