<?php

class SignupCtrl extends Signup {

    private $id;
    private $username;
    private $password;
    private $newpassword;
    protected $errors = [];
    protected $successMsg;

    public function __construct($username, $password, $newpassword) {
        $this->username    = $username;
        $this->password    = $password;
        $this->newpassword = $newpassword;
    }

    public function signupUser() {

        $this->validateForm();

        if(empty($this->errors)) {
            $this->setUser($this->username, $this->password, $this->newpassword);
        }
        
            

    }
    

    public function validateForm() {

        $this->validateNewpassword();
        $this->validateUsername();

        return $this->errors;

    }

    protected function validateUsername() {

        $val = $this->username;

        if(empty($val)) {
            $this->addError('username', 'اسم المستخدم لا يمكن ان يكون فارغ');
        }
        
    }

    
    protected function validateNewpassword() {
        
        $old = $this->password;
        $new = $this->newpassword;

        if(empty($old)) {
            $this->addError('oldpassword', 'كلمة السر لا يمكن ان تكون فارغة');
        } 

        if(empty($new)) {
            $this->addError('newpassword', 'كلمة السر الجديدة لا يمكن ان تكون فارغة');
        } 

    }
    
    protected function addError($key, $val) {
        if (!isset($this->errors[$key])) {
            $this->errors[$key] = [];
        }
        if (!in_array($val, $this->errors[$key])) {
            $this->errors[$key][] = $val;
        }
    }

    public function getSuccessMsg() {
        return $this->successMsg;
    }
   
}



?>