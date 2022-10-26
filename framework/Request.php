<?php

namespace Framework;

use Framework\Request\Cookies;
use Framework\Request\Files;
use Framework\Request\Headers;
use Framework\Request\Request as Request1;
use Framework\Request\Query;
use Framework\Request\Server;

class Request 
{

    public function request()
    {
        return new Request1();
    }

    public function query()
    {
        return new Query();
    }

    public function server()
    {
        return new Server();
    }

    public function file()
    {
        return new Files();
    }

    public function cookies()
    {
        return new Cookies();
    }

    public function header()
    {
        return new Headers();
    }

}