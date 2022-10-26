<?php

namespace Framework\Request;

class Headers 
{
    public function all()
    {
        return getallheaders();
    }

    public function get(string $key)
    {
        return getallheaders()[$key];
    }
}