<?php 
 class Account{
    private $errorArray;
    public function __construct(){
      $this-> errorArray = array();
    } 


    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2){
        $this->validateUsername($un);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em,$em2);
        $this->validateUserName($pw,$pw2);

        if(empty($this-> errorArray)){
         //Insert into db
         return true;
        }
        else{
            return false;
        }
    }



    private function validateUsername ($un){

       if(strlen($un)>25 || strlen ($un)<5){
           array_push($this->errorArray,"Your username must be between 5 and 25 characters");
           return;
       }

       //TODO: check if username exists
    }
    private function validateFirstName($fn){
        if(strlen($un)>25 || strlen ($un)<2){
            array_push($this->errorArray,"Your first name must be between 5 and 25 characters");
            return;
        }
    }
    private function validateLastName($ln){
        if(strlen($un)>25 || strlen ($un)<2){
            array_push($this->errorArray,"Your last name must be between 5 and 25 characters");
            return;
        }
    }
    private function validateEmails($em,$em2){
       if ($em != $em2){
        array_push($this->errorArray,"Your emails don't match");
        return;
       }
       if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
           array_push($this->errorArray,"Email is invalid");
           return;
       }
       //TODO: check that username hasn;t already being used

    }
    private function validatePasswords($pw,$pw2){
      if($pw != $pw2){
          array_push($this->errorArray,"Your passwords dont match");
          return;
      }
      if(preg_match('/[^A-Za-z0-9]/',$pw)){
        array_push($this->errorArray,"Your passwords can only contain numbers and letters");
        return;
      }
      if(strlen($pw)>30|| strlen ($pw)<5){
        array_push($this->errorArray,"Your passwords must be between 5 and 30 characters");
        return;
    }
    }
 }
?>