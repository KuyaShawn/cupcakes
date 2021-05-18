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

//Return true if at least one flavor is selected
function validFlavor($flavors)
{
    return !is_null($flavors);
}