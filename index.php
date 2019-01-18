<?php
#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#require autoload
require_once ('vendor/autoload.php');

#create an instance of the Base class
$f3 = Base::instance();

#Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

#define a default route
$f3->route('GET /', function() {
    echo '<h1>My Pets</h1>';
    echo "<a href='order'>Order a Pet</a>";
});

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

#run fat free
$f3->run();