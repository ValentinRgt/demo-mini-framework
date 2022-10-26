<?php

namespace Framework\Request;

class Cookies 
{
    public function all(string $key = null)
    {
        if($key){
            return $_COOKIE[$key];
        }else{
            return $_COOKIE;
        }
    }

    public function get(string $key)
    {
        return $_COOKIE[$key];
    }
}