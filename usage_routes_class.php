<?php
require_once("routes.php");
/*--The example usage of Routes class--*/
  //An array that contains the names of callable function names.
  $func=array("homePage","pagenotfound");
  //Making a new instance object of classs Routes.
  $routes=new Routes($func);
  //The switch statement process the different requests and sends them to their corresponding functions.
  switch ($_SERVER['REQUEST_URI']) {
  //I didn't used regular expressions but you must use them..
    case '/':
      $routes->actionTo('homePage');
      break;
    default:
      $routes->actionTo('pagenotfound');
      break;
  }
?>
