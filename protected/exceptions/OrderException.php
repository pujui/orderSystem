<?php
class OrderException extends Exception{

    const ERR_VALUE_IS_EMPTY  = 100; //輸入的值為空直
    const ERR_NOT_EXISTS = 101; // 該訂單不存在
    const ERR_CREATE_ORDER = 102; // 新增訂單失敗
    const ERR_OTHER = 103; // 新增訂單失敗

}