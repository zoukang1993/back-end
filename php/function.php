<?php
function love($type)
{
    echo "you love $type, no problem \n";  
}

call_user_func("love", "apple");   //you love apple, no problem
call_user_func("love", "games");  // you love games, no problem

//an example callback function
function my_callback_function()
{
    echo "hell";    
}

//an example callback method
class Myclass
{
    static function myCallbackMethod()
    {
        echo "my_callback_method";
    }
}

//type 1: simple callback
call_user_func("my_callback_func");


//type 2 static class method call
call_user_func(array('Myclass', 'myCallbackMethod'));

//type3 object method call
$obj = new Myclass();
call_user_func($obj, 'myCallbackMethod');

//type4 static class method call
call_user_func('Myclass::myCallbackMethod');

//type 5 relative static method call
class A
{
    public static function who()
    {
        echo "A\n";
    }
}

class B extends A
{
    public static function who()
    {
        echo "B\n";
    }
}

call_user_func(array('B', 'parent::who'));    //A

//type 6 implementing __invoke can be usered as callback
class C
{
    public function __invoke($name)
    {
        echo 'hello' . $name . "\n";    
    }
}

$c = new C();
call_user_func($c, 'php');

//使用closure
//out closure
$double = function ($a)
{
    return $a * 2;    
}


//a variable method
class Hello
{
    private $funcname = 'myfunc';

    public function run()
    {
        $var = $this->funcname;
        $this->var;
    }    

    public function myfunc()
    {
        echo 'hello, world!';    
    }
} 

$hello = new Hello();
$hello->run();     //hello, world!
?>
