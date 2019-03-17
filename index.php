<?php
session_start();

#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#require autoload
require_once ('vendor/autoload.php');

#create an instance of the Base class
$f3 = Base::instance();


#Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

$f3->set('colors', array('pink','green','blue'));

//require validation functions page
require_once('model/validation-functions.php');


#----------------------------------------------------------------
#define a default route
$f3->route('GET /', function() {
    echo '<h1>My Pets</h1>';
    echo "<a href='order'>Order a pet</a>";
});

#----------------------------------------------------------------
#define a route that accepts a parameter for animal type
$f3->route('GET /@animal', function($f3, $params) {

   //$animals = array('dog', 'cat', 'duck', 'cow', 'chicken');
   //$animal = $params['animal'];

    switch ($params['animal'])
    {
        case 'dog':
            echo 'WOOF!';
            break;
        case 'cat':
            echo 'Meow';
            break;
        case 'duck':
            echo 'Quack!';
            break;
        case 'cow':
            echo "Mooooo";
            break;
        case 'chicken':
            echo "Cluck!";
            break;
        default:
            echo $f3->error(404);
    }
});

#----------------------------------------------------------------
#define a route /order that renders form1.html
$f3->route('GET|POST /order',

    function($f3) {

    $_SESSION = array();

    if(isset($_POST['animal'])){

        $animal = $_POST['animal'];
        if(validString($animal)){
           $_SESSION['animal'] = $animal;
            $f3->reroute('/order2');
        }else{
            $f3->set("errors['animal']","Please enter an animal.");
        }
    }


    $view = new Template();
    echo $view->render('views/form1.html');

});#to form1

#define a route /order2 that uses POST
$f3->route('GET|POST /order2', function($f3)
{
    if(isset($_POST['color'])){
        $color = $_POST['color'];
        if(validColor($color)){
            echo "color chosen=>".$color;
            $_SESSION['color'] = $color;
            $f3->reroute('/results');
        }else{
            $f3->set("errors['color']","Please pick a color.");
        }
    }


    $template = new Template();
    echo $template->render('views/form2.html');
});#from form1 to form2

#define route for results
$f3->route('GET /results', function()
{

    $template=new Template();
    echo $template->render('views/results.html');
});#from form 2 to results

#run fat free
$f3->run();