<?php
class User{
    private $id, 
        $firstName, 
        $lastName, 
        $email, 
        $password, 
        $bio, 
        $joined, 
        $birthdate, 
        $isAdmin, 
        $sexe;
    
    
    
    public function __construct($id, $firstName, $lastName, $email, $password, $bio, $joined, $birthdate, $isAdmin, $sexe){
        $this->id           = $id;
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
        $this->email        = $email;
        $this->password     = $password;
        $this->bio          = $bio;
        $this->joined       = $joined;
        $this->birthdate    = $birthdate;
        $this->isAdmin      = $isAdmin;
        $this->sexe         = $sexe;
    }
    
    public function getName(){
        return $this->firstName . ' ' . $this->lastName;
    }
    
    public function getID(){
        return $this->id;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getEmail(){
        return $this->email;
    }
    
    public function getBio(){
        return $this->bio;
    }
    
}