<?php
class OrderException extends Exception{

    const ERR_VALUE_IS_EMPTY  = 100; //輸入的值為空直
    const ERR_NOT_EXISTS = 101; // 該訂單不存在

}