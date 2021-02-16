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
}
