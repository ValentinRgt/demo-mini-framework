<?php

namespace Framework\Request;

class Files 
{
    public function all(string $key = null)
    {
        if($key){
            return $_FILES[$key];
        }else{
            return $_FILES;
        }
    }

    public function get(string $key)
    {
        return $_FILES[$key];
    }
}