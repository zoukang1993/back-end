<?php
//namespace 类,(abstract, traits), interface, function, constant
namespace MyProject;

const CONST_OK = 1;
class Connection {}
function connect() {}
?>

<?php
namespace test;

//the following code will define the constant 'MESSAGE' in the global namespace (i.e. "\MESSAGE")
define("MESSAGE", "HELLO WORLD!");

//THE FOLLOWING CODE WILL DEFINE TWO CONSTANT IN THE 'test' namespace
define('test\Hello', "hello world!");
define(__NAMESPACE__ . '\goodbye', 'goodbye cruel world');
?>

<?php
//定义子明明空间
namespace MyProject\Sub\Level;   
const CONNECT_OK = 1;
class Connection {}
function connect() {}

//上面的例子创建了常量MyProject\Sub\Level\CONNECT_OK，类 MyProject\Sub\Level\Connection和函数
//MyProject\Sub\Level\connect。
?>

<?php
//在同一个文件中定义多个命名空间

namespace MyProject {
    const CONNECT_OK = 1;    
    class Connection {}      
    function connect() {}
}

namespace AnotherProject {
    const CONNECT_OK = 1;
    class Connection {}
    function connect() {}
}
?>

<?php
//限定名称,非限定名称,完全限定名称
#php1.php
namespace Foo\Bar\subnamespace;

const FOO = 1;
function foo() {}
class foo
{
    static function staticmethod() {}
}
?>

<?php
namespace Foo\Bar;
include 'file1.php';

const FOO = 2;
function foo() {}
class foo
{
    static function staticmethod() {}
}

#非限定名称
foo(); //解析为 Foo\Bar\foo resolves to function Foo\Bar\foo
foo::staticMethod();
echo Foo;

#限定名称
subnamespace\foo(); // 解析为函数 Foo\Bar\subnamespace\foo
subnamespace\foo::staticmethod(); // 解析为类 Foo\Bar\subnamespace\foo,
                                    // 以及类的方法 staticmethod
echo subnamespace\FOO; // 解析为常量 Foo\Bar\subnamespace\FOO

#完全限定名称
\Foo\Bar\foo(); // 解析为函数 Foo\Bar\foo
\Foo\Bar\foo::staticmethod(); // 解析为类 Foo\Bar\foo, 以及类的方法 staticmethod
echo \Foo\Bar\FOO; // 解析为常量 Foo\Bar\FOO

?>


<?php?>
<?php?>

<?php?>
<?php?>
<?php?>
<?php?>
<?php?>

<?php?>
<?php?>
<?php?>
<?php?>
<?php?>

