<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// start a session
session_start();

//Require autoload file
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Define routes
$f3->route('GET|POST /', function($f3){
    $userFlavors = array();

    /* If the form has been submitted, add the data to session
 * and send the user to the next order form
 */
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //If name is valid, store data
        if(validName($_POST['name'])) {
            $_SESSION['name'] = $_POST['name'];
        }
        //Otherwise, set an error variable in the hive
        else {
            $f3->set('errors["name"]', 'Please enter a Name');
        }

        //If flavors are selected
        if (validFlavor($_POST['flavors']))
        {
            $userFlavors = $_POST['flavors'];
            //Get user input
            $_SESSION['userFlavors'] = $userFlavors;
            $_SESSION['total'] = number_format((double)count($userFlavors) * 3.50, 2);
        }else{
            $f3->set('errors["flavors"]', 'Please select one or more flavors');
        }

        //If there are no errors, redirect to summary route
        if (empty($f3->get('errors'))) {
            header('location: summary');
        }
    }

    //Get the flavors from the Model and send them to the View
    $f3->set('flavors', getFlavors());
    $f3->set('userFlavors', $userFlavors);

    // Display the home page
    $view = new Template();
    echo $view -> render('views/home.html');
});

// Summary page
$f3->route('GET /summary', function(){

    // Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');

});

//Run Fat-Free
$f3->run();