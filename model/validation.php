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
    $validFlavor = getChoices();

    //Make sure each selected choices is valid
    foreach ($flavor as $userChoice) {
        if (!in_array($userChoice, $validFlavor)) {
            return false;
        }
    }
    //All choices are valid
    return true;
}