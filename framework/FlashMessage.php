<?php

namespace Framework;

class FlashMessage
{
    public static function setFlashMessage($type, $message){
        setCookie("flashMessage", json_encode(array("type" => $type, "message" => $message)), time() + 3600*24, "/", $_SERVER["HTTP_HOST"], false, false);
    }
    
    public static function getFlashMessage(){
        if(isset($_COOKIE["flashMessage"])){
            $json_data = json_decode($_COOKIE["flashMessage"]);
            return array("type" => $json_data->type, "message" => $json_data->message);
        }
        return null;
    }
    
    public static function resetFlashMessage(){
        setCookie("flashMessage", "", -1, "/", $_SERVER["HTTP_HOST"], false, false);
    }
}