<?php

namespace Framework\Request;

class Server 
{
    public function all(string $key = null)
    {
        if($key){
            return $_SERVER[$key];
        }else{
            return $_SERVER;
        }
    }

    public function get(string $key)
    {
        return $_SERVER[$key];
    }
}