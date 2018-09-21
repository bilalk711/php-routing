<?php
/*-- This code creates a base for creating routing mechanism in PHP --*/
/*-- It is not prepared for use in production --*/

//Interface for Routes class.
interface route{
     function actionTo($action,$method);
}
class Routes implements route{
      private $funcNames;
      //Puting each value of given argument array to the private array.
      function __construct($func){
               $this->funcNames=array();
               foreach ($func as $value) {
                 array_push($this->funcNames,$value);
               }
      }
      public function actionTo($action,$method='GET'){
             //Check if the called function exists in the private array $funcNames.
             if(in_array($action,$this->funcNames)){
               //Check if the global array SERVER's REQUEST_METHOD value matches the one defined for the callback function.
               if($_SERVER['REQUEST_METHOD']==$method)
               {
                  $action();
               }
               //else redirect to invalid parameters page.
               else{
                  header(__INVALID_METHOD__);
               }
           }
           //else redirect to page not found error.
           else{
                header(__404_ERROR_PAGE__);
           }
      }
}
?>
