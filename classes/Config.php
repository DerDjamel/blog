<?php
class Config {
    public static function get($config_name){
        return $GLOBALS["config"][$config_name];
    }
}