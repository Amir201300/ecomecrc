<?php

/**
 * @return string
 */
function get_baseUrl()
{
    return url('/');
}

/**
 * @return mixed
 */
function get_user_lang()
{
    return Auth::user()->lang;
}

/**
 * @param $total
 * @param $number
 * @param $type
 * @return float|int
 */
function getRateNumber($total,$number,$type){
    $discount_amount= $number;
    if($type==2) {
        $discount_amount = ($total * $number / 100);
    }
    return $discount_amount;


    function getDiscountCode(){
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
