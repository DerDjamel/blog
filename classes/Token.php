<?php
class Token {
    private static $token;
    
    public static function generate(){
        return md5(uniqid());
    }
    
    public static function create(){
        self::$token = self::generate();
        $_SESSION['token'] = self::$token;
        return self::$token;
    }
    
    public static function destroy(){
        $_SESSION['token'] = NULL;
        return true;
    }
    
    public static function generateHtmlToken(){
        self::$token = self::create();
        return "<input type=\"hidden\" name=\"token\" value=\"". self::$token . "\">";
    }
    
    public static function isValid(){
        if(isset($_POST['token'])){
            $user_token = $_POST['token'];
            $stored_token = $_SESSION['token'];
            return ($stored_token === $user_token);
        } else {
            return false;
        }
    }
    
    
}