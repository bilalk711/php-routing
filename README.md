# php-routing
A simple basic routing mechanism. It contains a single class that contains methods that could be used for implement the routing system.

# How to use?
This code contains a class that has a single method. This method calls an appropraite function for each URL request. The class object initializes with an array of valid callback function names. This helps in quickly checking whether the function is valid or otherwise call the 404 page not found function. You have to define the functions for each request that your project may get. This mechanism can only handle GET or POST requests though it can be improved by extending the class. 
Here is the code:

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
        
You have to give a list of valid callback function names to this class. It then stores these names into it's private array and checks whether it is valid or not before calling it. 
Here is how you would do that:        


        //An array that contains the names of callable function.
        $func=array(__VALID_CALLBACK_FUNCTION_NAMES__);
        //Making a new instance object of classs Routes.
        $routes=new Routes($func);
          switch ($_SERVER['REQUEST_URI']) {
                 case __YOUR_SPECIFIC__:
                            $routes->actionTo(__YOUR_FUNCTION_NAME__,__YOUR_REQUEST_METHOD__);
                            break;
                 default:
                            $routes->actionTo(__YOUR_404_ERROR_PAGE__);
                            }
  
 You should use PHP's builtin Regular Expression functions such as preg_match to check if the Request URL exactly matches your case or else redirect to a 404 error page. 
 
 #Things to Note
 This mechanism is by no means an actual implementation you can use for routing in standard projects. It may put security issues and make your website easier to be hackable. T
 It should be used as a base to understand what a routing mechanism should function like. 
 For larger projects, you should use PHP's framework Laravel that has builtin support for routing. 
