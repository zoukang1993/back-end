<?php
//一个类可以包含有属于自己的常亮，变量（称为‘属性’）以及函数‘称为‘方法’;
class SimpleClass
{
    //property declaration
    public $var = 'a default value';

    //method declaration
    public function disPlayVar()
    {
        echo $this->var;
    }
}

class ExtendClass extends SimpleClass
{
    public function disPlayVar()
    {
        echo "extending class \n";
        parent:: disPlayVar();
    }
}

$extendClass = new ExtendClass();
$extendClass->disPlayVar();
//extending class
//a default value
?>

<?php
//::class
namespace Ns {
    class ClassName{
    }

    echo ClassName::class;
}
//Ns\ClassName

?>


<?php
// void __construct()

class BaseClass
{
    function __construct()
    {
        print "In BaseClasss Constructor\n";
    }
}

class SubClass extends BaseClass
{
    function __construct()
    {
        parent::__construct;
        print "In SubClass Constructor\n ";
    }
}

class OtherClass extends BaseClass
{
    //inheritss BaseClass's constructor
}
?>


<?php
//public protected  private   访问控制
class MyClass
{
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';

    //声明一个公有的构造函数
    public __construct () {}

    //声明一个共有的方法
    public function MyPublic() {}

    //声明一个受保护的方法
    private function MyProtected() {}

    //声明一个私有的方法
    private function MyPrivate() {}

    //此方法公有
    function foo()
    {
        $this->MyPublic();
        $this->MyProtected();
        $this->MyPrivate();
    }
}

?>


<?php
//范围解析操作符 ::, 用于访问静态成员，类常亮，还可用于覆盖类中的属性和方法

//在类外部使用::操作符
class MyClass
{
    const CONST_VALUE = "A constant value";
}

$className = 'MyClass';
echo $className::CONST_VALUE;
echo MyClass::CONST_VALUE;

//self，parent 和 static 这三个特殊的关键字是用于在类定义的内部对其属性或方法进行访问的。
class OtherClass extends MyClass
{
    public static $my_static = 'static var';
    public static function doubleColon()
    {
        echo parent::CONST_VALUE . "\n";
        echo self::$my_static . "\n";
    }
}

$className = 'OtherClass';
echo $className::doubleColon();
OtherClass::doubleColon();




class A
{
    public Static $B = '1';   #static class variable

    const B = '2';

    public static function B()
    {
        return '3'；
    }

}

echo A::$B . A::B . A::B();   #OUTPUT   123 
?>

<?php
#abstract 定义为抽象的类不能被实例化，继承一个抽象类时候，子类中必须定义父类中所有的抽象方法，

abstract class Abstract
{
    //强制要求子类中定义这些方法
    abstract protected function getValue();
    abstratct protected function prefixValue($prefix);

    //普通方法（非抽象方法）
    public function printOut()
    {
        print $this->printOut() . "\n";
    }
}

class ConcreteClass1 extends Abstract
{
    protected function getValue()
    {
        return "ConcreteClass1";
    }

    public function prefixValue($prefix)
    {
        return "{$prefix}ConcreteClass1";
    }
}

class ConcreteClass2 extends ConcreteClass1
{
    public function getValue()
    {
        return "ConcreteClass2";
    }

    public function prefixValue($prefix)
    {
        return "{$prefix}ConcreteClass2";
    }
}

$class1 = new ConcreteClass1;
$class1->printOut();    #ConcreteClass1
echo $class1->prefixValue('FOO_'). "\n";   #FOO_ConcreteClass1

$class2 = new ConcreteClass2;
$class2 ->printOut();   #ConcreteClass2
echo $class2->prefixValue('FOO_'). "\n";    #F00_ConcreteClass2
?>

<?php
//对象接口  interface implements
//声明一个 ‘iTemplate’ 接口
interface iTemplate
{
    public function setVariable($name, $var);
    public function getHtml($template);
}

class Template implements iTemplate
{
    private $vars = array();
    public function setVariable($name, var)
    {
        
        $this->vars[$name] = $var;
    }

    public function getHtml($template)
    {
        foreach ($this->vars as $name => $value) {
            $template = str_replace('{' . $name . '}', $value ,$template);
        }
        return $template;
    }
}


//可扩充的接口
interface a
{
    public function foo();
}

interface b extends a
{
    public function baz(Baz, $baz);
}

class c implements b
{
    public function foo() {}
    public function baz(Baz $baz) {}
}

//继承多个接口
interface aa
{
    public function foo();
}

interface bb
{
    public function bar();
}

interface cc extends aa, bb
{
    public function baz();
}

class dd implements cc
{
    public function foo() {}
    public function bar() {}
    public function baz() {}
}
?>

<?php
//trait
trait ezcReflectionReturnInfo
{
    function getReturenType() {}
    function getReturenDescription() {}
}

class ezcReflectionMethod extends ReflectionMethod
{
    use ezcReflectionReturnInfo;

}

class ezcReflectionFunction extends ReflectionFunction
{
    use ezcReflectionReturnInfo;
}

//优先级 当前类的成员方法覆盖trait 的方法，而trait方法覆盖基类中的方法

//多个trait,通过逗号分割，在use 声明列出多个trait,可以都插入到一个类中
//use trait1, trait2, trait3 , ..., traitn;

//冲突解决
//insteadof  as

trait A
{
    public function samllTalk()
    {
        echo 'a';
    }

    public function bigTalk()
    {
        echo 'b';
    }
}

trait B
{
    public function smallTalk()
    {
        echo 'b';
    }

    public function bigTalk()
    {
        echo 'b'；
    }
}



class Talker
{
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
    }
}

class Aliased_Takler
{
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as talk;
        B::bigTalk as protected myBigTalk;
    }
}
?>

<?php
//匿名类  php7 开始支持
//php 7之前
class Logger
{
    public function log($msg) 
    {
        echo $msg;
    }
}
$util->setLogger(new Logger);

//php7之后
$util->setLogger(new class {
    public function log($msg)
    {
        echo $msg;
    }
});
?>

<?php
//重载 overloading , 动态创建类属性和方法

?>


<?php
//遍历对象 foreach

class MyClass
{
    public $var1 = 'value 1';
    public $var2 = 'value 2';
    public $var3 = 'value 3';
    protected $protected = 'protected var';
    private $private = 'private var';

    function iterateVisible()
    {
        echo "MyClass::iterateVisible:\n";
        foreach ($this as $key => $value) {
            print "$key => $value";
        }
    }
}

$class = new MyClass();

foreach($class as $key => $value) {
    print "$key => $value";    
}
echo "\n";

$class->iterateVisible();
?>


<?php?>



<?php
//魔术方法
__construct() __destruct() __call() __callStatic() __set() __get() __isset() __unset() __sleep()
__wakeup() __toString() __invoke() __set__state() __clone() __debugInfo() 


class ToSting
{
    public $foo;
    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function __toString()
    {
        return $this->$foo;
    }
}

$class = new ToString('hello');
echo $class;    #hello
?>

<?php
//final 如果父类的方法被声明为final,则子类无法覆盖该方法,如果一个类被声明为final,则不能被继承

?>

<?php
//类型约束  函数的参数可以制定必须为对象, 接口,数组或者callbale.

class MyClass
{
    //测试函数 第一个参数必须为otherClass类的一个对象
    public function test(OtherClass $otherCLass)
    {
        echo $otherClass->var;
    }

    //第一个参数必须为数组
    public function test_array(array $input_array)
    {
        print_r($input_array);    
    }

    //第一个参数必须为递归类型
    public function test_interface(Traverasble $iterator)
    {
        echo get_class($iterator);    
    }

    //第一个参数必须为回调类型
    public function test_callable(callable $callback, $data)
    {
        call_user_func($callback, $data);    
    }
}

//OtherClass 类定义
class OtherClass
{
    public $var = 'Hello World';    
}

?>

<?php?>

