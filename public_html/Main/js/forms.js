$(document).ready(function(){
   
   function validSignUp(){
       var pwd = $("#pwd").val();
       var confirm_pwd = $("#confirm_pwd").val();
       var username = $("#username").val();
       var email = $("#email").val();
   
       if(pwd.length < 8){
           $("#password-feedback").text("Password is too short");
           $("#pwd").addClass("is-invalid");
           return false;
       }
   
        else if(pwd !== confirm_pwd){
            $("#password-feedback").text("The passwords do not match");
            $("#pwd").addClass("is-invalid");
            $("#confirm_pwd").addClass("is-invalid");
            return false;
        }       
        
        return true;
   } 
   
   
   function validSignIn(){
       var username = $("#username").val();
       var pwd = $("#password").val();
       
       console.log(username+" pwd: "+pwd);
       
       if(username !== "Jerry"){
           $("#username").addClass('is-invalid');
           return false;
       }else{
           $("#username").removeClass('is-invalid');
       }
       
       if(pwd !== "JerryB123"){
           $("#password").addClass('is-invalid');
           return false;
       }
       
       return true;    
   }
   
   
   $(".sign-up").submit(function(event){
        if(!validSignUp()){
            event.preventDefault();
        }
   });
    
    $(".sign-in").submit(function(event){
        if(!validSignIn()){
           event.preventDefault();
       } 
    });
    
});