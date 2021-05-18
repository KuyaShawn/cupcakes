<?php
/* validation.php
 * Validate data
 *
 */

//Return true if name is valid
function validName($name)
{
    return strlen(trim($name)) >= 2;
}

//Return true if *all* choices are valid
function validFlavor($flavor)
{
    $validFlavor = getFlavors();

    //Make sure each selected choices is valid
    foreach ($flavor as $userChoice) {
        if (!in_array($userChoice, $validFlavor)) {
            return false;
        }
    }
    //All choices are valid
    return true;
}

function getPrice(){
    $basePrice = 0.00;
    if ($size == 'small') {
        $basePrice = 8.99;
    } elseif ($size == 'medium') {
        $basePrice = 12.99;
    } else {
        $basePrice = 16.99;
    }

    return $basePrice;

}