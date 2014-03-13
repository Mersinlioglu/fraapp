<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    
    private $_id;
    private $_type;
    private $salt = "apIdj12p3tEr308u./43Fnhsdi8jkna sd78()),..-asd";


    public function authenticate() {

        $record=User::model()->findByAttributes(array('username'=>$this->username,'deleted'=>0));
        if($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if($record->password !== md5($this->salt.$this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $record->id;
            $this->_type = $record->type;
            $this->errorCode = self::ERROR_NONE;
            // $this->setState('last_login', $record->last_login);
            $this->setState('type', $this->_type);
            // $record->last_login = time();
            // $record->save();
        }
        return !$this->errorCode;
    }
 
    public function getId() {
        return $this->_id;
    }

    public function isAdmin() {
        return $this->_type == User::ADMIN || $this->_type == User::DIRECTOR;
    }
}