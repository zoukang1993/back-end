<?php
// 一个基本的购物车，包括一些已经添加的商品和每种商品的数量。
// 其中有一个方法用来计算购物车中所有商品的总价格，该方法使
// 用了一个 closure 作为回调函数。
class Cart
{
    const PRICE_BUTTER = 1.00;
    const PRICE_MILK = 3.00;
    const PRICE_EGGS = 6.95;

    protected $products = array();

    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }

    public function getQuantity($product)
    {
        return isset($this->products[$product]) ?
        $this->products[$product] : false;
    }

    public function getTotal($tax)
    {
        $tax = 0.00;
        $callback =
            function($quantity, $product) use ($tax, &$total)
            {
                $pricePerItem = constant(__CLASS__ . "::PRICE_" . STRTOUPPER($product));
                $total += ($pricePerItem * $quantity) * ($tax + 1.0);
            }

        array_walk($this->products, $callback);
        return ($total, 2);;
    }
}

$my_cart = new Cart;


//往购物车中添加条目
$my_cart->add('butter', 1);

$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

//打出总价格，其中有5%的销售税
print $my_cart->getTotal(0.005). "\n";
//最后结果是54.29



class Test
{
    public function testing()
    {
        return function()
        {
            var_dump($this);
        }
    } 
}

$object = new Test;
$function = $object->testing();
$function();        //object(Test)#1 (0) {}
?>
