# musicplayer

Clone of spotify
#Story behind the register button

1. First the user fills in the Register form and will click on the submit button
   a. Then the Register button will be trigeering the function
   `if(isset($_POST['registerButton'])) {`

   b.It will create the account object

2. When this is called, there will be sanitization happening on the first few lines and also in the next line it will
   execute the register function for the account object

3.Register function when executed will lookin to the account object and few things happen here

4. How register function executes like this `account-> register ?` This is because the register function is a method in the account class. And in the Register function there are all validation functions for the other fields

5. How does the validations happen in this register function? There are several things taking care of this

   a) There is a private variable - array
   b) This variable is being initialized into an array by the constructor function
