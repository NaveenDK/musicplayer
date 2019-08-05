<?php

function sanitizeFormPassoword ($inputText)
{
    $inputText  = strip_tags($inputText);
    return $inputText;
} 
 function sanitizeFormUsername($inputText){
     $inputText = strip_tags($inputText);
     $inputText = str_replace(" ","",$inputText);
     return $inputText;
 }

 function sanitizeFormString($inputText){
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ","",$inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}

if(isset($_POST['loginButton'])){

}

if(isset($_POST['registerButton'])){
    $username= sanitizeFormUsername($_POST['username']);

    $firstname = sanitazeFormString($_POST['firstName']);
    
    $lastname = sanitazeFormString($_POST['lastName']);

    $email = sanitizeFormString($_POST['email']);
    $email2 = sanitizeFormString($_POST['email2']);

    $password = sanitizeFormPassword($_POST['password']);
    $password2 = sanitizeFormPassword($_POST['password']);
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Musicapp vo1</title>
</head>
<body>
    <div id="inputContainer">
       <form id="loginForm" action="register.php" method="POST">
        <h2>Login to your account</h2>
        <p>
        <label for="loginUsername">Username</label>
        <input id="loginUsername" name="loginUsername" type="text" placeholder="eg:John" required>
        </p>
        <p>   
        <label for="loginPassword" placeholder="Your Password" >Password</label>
        <input id="loginPassword" name="loginUsername" type="text" placeholder="eg:John" required>
        </p>
         <button type="submit" name="loginButton">LOGIN</button>
       </form>
       
       
       <form id="registerForm" action="register.php" method="POST">
        <h2>Create your free account</h2>
        <p>
            <label for="username">Username</label>
            <input id="username" name="username" type="text" placeholder="eg:John" required>
        </p>
        <p>
            <label for="firstName">First name</label>
            <input id="firstname" name="firstname" type="text" placeholder="eg:John" required>
        </p>
        <p>
            <label for="lastName">Last name</label>
            <input id="lastname" name="lastname" type="text" placeholder="eg:John" required>
        </p>
        <p>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="eg:John@email.com" required>
        </p>
        <p>
            <label for="email2">Confirm Email</label>
            <input id="email2" name="email2" type="email" placeholder="eg:John" required>
        </p>
        <p>   
            <label for="password"  placeholder="Your Password">Password</label>
            <input id="password" name="password" type="password"  required>
        </p>
        <p>   
            <label for="password2"  placeholder="Your Password">Confirm Password</label>
            <input id="password2" name="password2" type="password"  required>
        </p>
         <button type="submit" name="registerButton">Sign Up</button>
       </form>
       

    </div>
</body>
</html>