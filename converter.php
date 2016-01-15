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
 * TODO: Styles
 *
 *
 */


define('THIS_PAGE', basename($_SERVER['PHP_SELF']));
define('USER_ERROR', 'Erroneous Input, Please try again.');

define('THIS_FORM', '
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
    ');

$formIsSet = isset($_POST['submit']);
display($formIsSet?checkForm($_POST['user-input']):'');


/**
 * check if input is valid. If so perform conversion
 * *if not, return error
 * @param $userInput
 * @return null|string
 */
function checkForm($userInput)
{
    return(is_numeric($userInput))?convert($userInput):USER_ERROR;
}

/**
 * Display form + message content (error, table)
 * @param $message
 */
function display($message)
{
    echo THIS_FORM . $message;
}

/**
 * Switches on radio values
 * @param $input
 * @return null|string
 * @internal param $type
 * @internal param int $temp
 */

function convert($input)
{
    switch ($_POST['type']) {

        case 'Fahrenheit':
            $degF = $input;
            $degC = number_format(($input - 32) * 5/9, 2);
            $degK = number_format(($input + 459.67) * 5/9, 2);
            break;

        case 'Celsius':
            $degF = number_format($input * 9/5 + 32, 2);
            $degC = $input;
            $degK = number_format($input + 273.15, 2);
            break;

        case 'Kelvin':
            $degF = number_format($input * 9/5 -459.67, 2);
            $degC = number_format($input - 273.15, 2);
            $degK = $input;
            break;

        default:
            return "Erroneous Input.";
    }
    return
        <<<TABLE
        <table>
            <tr><td>Fahrenheit: </td><td>$degF</td></tr>
            <tr><td>Celsius: </td><td>$degC</td></tr>
            <tr><td>Kelvin: </td><td>$degK</td></tr>
        </table>
TABLE;
}
