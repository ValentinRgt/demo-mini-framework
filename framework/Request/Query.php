<?php

namespace Framework\Request;

class Query 
{
    public function all(string $key = null)
    {
        if($key){
            return $_GET[$key];
        }else{
            return $_GET;
        }
    }

    public function get(string $key)
    {
        return $_GET[$key];
    }
}