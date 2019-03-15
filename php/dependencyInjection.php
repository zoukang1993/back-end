<?php
//用php实现一个轻量的依赖注入容器
class Di
{
    protected $_service = [];
    protected $_shareService = [];
    public function set($name, $definition, $shared = false)
    {
        if ($shared) {
            $this->_shareService[$name] = $definition;    
        } else {
            $this->_service[$name] = $definition;
    }

    public function get($name)
    {
        if ($is_set($this->_service[$name])) {
            $definition = $this->_service[$name];    
        } else if ($this->_shareService[$name]) {
            $definition = $this->_shareService[$name];
        } else {
            throw new Exception("service'" . name . "'wasn't found in the dependency injection    
             container");  
       }             
        //....

        if (is_object($definition)) {
            $definition = call_user_func($definition);    
        }

        return $definition;
    }
}

//redisDB提供一个redis数据库操作,在这个类中我们实现了redis的查询,保存和杀出
class redisDB
{
    protected $_di;
    protected $_options;

    public function __construct($options = null)
    {
        $this->_options = $options;
    }

    public function setDI($di)
    {
        $this->_di = $di;
    }

    public function find($key, $lifetime)
    {
        //doce    
    }

    public function save($key, $value, $lifetime)
    {
        //code    
    }

    public function delete($key)
    {
        //code    
    }
}


//cache 提供一个缓存功能的实现并且依赖于redisDB
class cache
{
    protected $_di;
    protected $_options;
    protected $_connect;

    public function __construct($options = null)
    {
        $this->_options = $options;    
    }

    public function setDI($di)
    {
        $this->_di = $_di;    
    }

    public function __connect()
    {
        $options = $this->_options;
        if (is_set($options['connect'])) {
            $service = $options['connect'];
        } else {
            $service = 'redis';    
        }

        return $this->_di->get($service);
    }

    public function get($key, $lifetime)
    {
        $connect = $this->_connect;
        if (!is_object($connect)) {
            $connect = $this->_connect();
            $this->_connect = $connect;
        }

        //code
        //...

        return $connect->find($key, $lifetime);
    }

    public function save($key, $value, $lifetime)
    {
        $connect = $this->_connect();
        if (!is_object($connect)) {
           $connect = $this->_connect();
           $this->_connect = $connect;
        }

        //code .....

        return $connect->save($key, $lifetime);
    }

    public function delete($key)
    {
        $connect = $this->_connect();
        if (!is_object($connect)) {
            $connect = $this->_connect();
            $this->_connect = $connect;
        }

        //code ....
        
        return $connect->delete($key, $lifetime);
    }
}

//将上述两个组件注入到容器中
$di = new Di();
$di->set('redis', function(){
    return new redisDB([
        'host' => '127.0.0.1',
        'port' => 6379
    ]);
});

$di->set('cache', function(){
    $cache = new cache([
        'connect' => 'redis'
    ]);
});

//然后在任何你想使用cache的地方
$cache = $di->get('cache');
$cache->get('key');     //获取缓存数据
$cache->save('key', 'value', 'lifetime');       //保存数据
$cache->delete('key');          //删除数据

interface BackendInterface
{
    public function find($key, $lifetime);
    public function save($key, $value, $lifetime);
    public function delete($key);
}

class redisDB implements BackendInterface
{
   public function find($key, $lifetime) {};         
   public function save($key, $value, $lifetime) {};
   public function delete($key) {};
}

class mongoDB implements BackendInterface
{
   public function find($key, $lifetime) {};         
   public function save($key, $value, $lifetime) {};
   public function delete($key) {};
}

class file implements BackendInterface
{
    public function find($key, $lifetime) {};         
    public function save($key, $value, $lifetime) {};
    public function delete($key) {};
}

$di = new Di();
//redis
$di->set('redis', function() {
    return new redisDB([
        'host' => 127.0.0.1,
        'port' => 6379
    ]);
});

//mongoDb
$di->set('mongo', function() {
    return new mongoDb([
        'host' => 127.0.0.1,
        'port' => 12707
    ]);
});

//file
$di->set('file', function() {
    return new file([
        'path' => 'path'
    ]);
});

//save at redis
$di->set('fastCache', function() use($di) {
    $cache = new cache([
        'connect' = > 'redis'
    ]);
    $cache->setDi($di);
    return $cache;
});

//save at mongoDB
$di->set('cache', function() use($di) {
    $cache = new cache([
        'connect' => 'mongo'
    ]);
    $cache->setDi($di);
    return $cache;
});

//save at file
$di->set('slowCache', function() use($di) {
    $cache = new cache([
        'connect' => 'file'
    ]);
    $cache->setDi($di);
    return $cache;
});

//然后在你想使用cache的地方
$cache = $di->get('cache');


//自动setDi
interface DiAwareInterface
{
    public function setDi($di);
    public function getDI();
}

class Di
{
    protected function set($name, $definition)
    {
        $this->service[$name] = $definition;
    }

    public function get($name)
    {
        //...
        if ($is_object($definition)) {
            $instance = call_user_func($definition);    
        }

        //如果实现了DiAwareInterface这个接口,自动注入
        if (is_object($instance)) {
            if ($instance instanceof DiAwareInterface) {
                $instance->setDI($this);    
            }
            
        }
          
      return $instance;
    }
}

class redisDB implements backendInterface, DiAwareInterface
{
    public function find($key, $lifetime) {};
    public function save($key, $value, $lifetime) {};
    public function delete($delete) {};
}

//finially
$di->set('cache', function() {
    return new cache([
        'connect' => 'mongo'
    ]);
});

?>
