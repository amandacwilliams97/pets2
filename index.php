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


#----------------------------------------------------------------
#define a default route
$f3->route('GET /', function() {
    echo '<h1>My Pets</h1>';
    echo "<a href='order'>Order a Pet</a>";
});

#----------------------------------------------------------------
#define a route that accepts a parameter for animal type
$f3->route('GET /@animal', function($f3, $params) {
    $animals = ['dog', 'cat', 'duck', 'cow', 'chicken'];
    $animal = $params['animal'];

    switch ($animal) {
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
            $f3->error(404);
    }
});

#----------------------------------------------------------------
#define a route /order that renders form1.html
$f3->route('GET /order', function($f3) {

    $view = new View();
    echo $view->render('views/form1.html');

    $f3->set('colors', array('pink', 'green', 'blue'));

});#to form1

#define a route /order2 that uses POST
$f3->route('POST /order2', function() {
    $_SESSION['animal'] = $_POST['animal'];
    $view = new View();
    echo $view->render('views/form2.html');
});#from form1 to form2

#define route for results
$f3->route('POST /results', function() {
    $_SESSION['color'] = $_POST['color'];
    $template=new Template();
    echo $template->render('views/results.html');
});#from form 2 to results

#run fat free
$f3->run();