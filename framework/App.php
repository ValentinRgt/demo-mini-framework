<?php

namespace Framework;

use App\Entity\User;

class App
{
    public function flashes(){
        FlashMessage::resetFlashMessage();
        return FlashMessage::getFlashMessage();
    }

    public function cookies(){
        return $_COOKIE;
    }

    public function user()
    {
        if(isset($_COOKIE["logged"])){
            return (new User())->setFirstname("John")->setLastname("Doe")->setEmail("john.doe@john.com");    
        }

        return false;
    }

}