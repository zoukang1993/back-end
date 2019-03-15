<?php
function barber($type)
{
    echo "you wanted a $type haircut, no problem \n";    
}

call_user_func("barber", "mushroom");    //you wanted a mushroom  haircut, no problem
call_user_func("barber", "shave");      //ypu wanted a shave haircut, no oblem



?>
