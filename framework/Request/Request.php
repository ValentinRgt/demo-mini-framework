<?php

namespace Framework\Request;

class Request 
{
    public function all(string $key = null)
    {
        if($key){
            return $_POST[$key];
        }else{
            return $_POST;
        }
    }

    public function get(string $key)
    {
        return $_POST[$key];
    }
}