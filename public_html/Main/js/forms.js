$(document).ready(function(){

    getDefaults();
   
   //On keyup; ensures that the email address does not exist  
   $(".sign-up #email").change(function(){
        validEmail();
   });
   
   $(".update #email").change(function(){
        availableEmail();
   });
   
   $(".sign-up").submit(function(event){
       //On submit...ensures that the passwords match and are long enough and the email address does not exist in DB  
       if(!validPwd() || !validEmail()){
            event.preventDefault();
        }
   });
   
   $(".update").submit(function(event){
       //On submit...ensures that the passwords match and are long enough and the email address does not exist in DB  
       if(!availableEmail()){
            event.preventDefault();
        }
   });
    
    $(".sign-in").submit(function(event){
        if(!validSignIn()){
           event.preventDefault();
       } 
    });
   
   
   var valid = false;
   function validEmail(){
       var email = $("#email").val();
       
       $.post("php/sign-up-action.php", {email: email}, function(data){
            console.log(data);
            if(data === "email-exists"){               
                $("#email").addClass("is-invalid");
                valid = false;
            }else{
                $("#email").removeClass("is-invalid");
                valid = true;
            }
        });
        
        console.log("Email: "+valid);
        return valid;
   }
   
   function availableEmail(){
       var email = $("#email").val();
       
       $.post("php/update_details.php", {email: email}, function(data){
            console.log(data);
            if(data === "email-exists"){               
                $("#email").addClass("is-invalid");
                valid = false;
            }else{
                $("#email").removeClass("is-invalid");
                valid = true;
            }
        });
        
        console.log("Email: "+valid);
        return valid;
   }
   
   
   
 
   function validPwd(){
       var pwd = $("#pwd").val();
       var confirm_pwd = $("#confirm_pwd").val();
       var valid = false;
   
       if(pwd.length < 8){
           $("#password-feedback").text("Password is too short");
           $("#pwd").addClass("is-invalid");
           valid=false;
       }
   
        else if(pwd !== confirm_pwd){
            $("#password-feedback").text("The passwords do not match");
            $("#pwd").addClass("is-invalid");
            $("#confirm_pwd").addClass("is-invalid");
            valid=false;
        }else{
            valid = true;
        }
           
        return valid;
   } 
   
   
   var valid_sign_in = false;
   function validSignIn(){
       var email = $(".sign-in #email").val();
       var pwd = $(".sign-in #pwd").val();
       console.log("Email:"+email);
       
       $.post("php/sign-in-action.php", {email: email, pwd: pwd}, function(data){
           console.log(data);
           if(data ==="invalid-email"){
               //Show error
               $("#email").addClass("is-invalid");
               valid_sign_in = false;
           }else if(data === "invalid-pwd"){
               //Show error
               $("#email").removeClass("is-invalid");
               $("#pwd").addClass("is-invalid");
               valid_sign_in = false;
           }else{
               valid_sign_in = true;
               window.location.replace("home.php");
           }
       });   
       
       console.log("Validity: "+valid_sign_in);
        return  valid_sign_in;
   }
   
   function getDefaults(){
       //Preliminaries
        //Prevent resubmission on refresh or back
       if(window.history.replaceState){
          window.history.replaceState(null, null, window.location.href); 
       }
       //turn off auto-complete
       $("#add-hostel-form").attr("autocomplete", "off");

      //Default value for the country code list 
      $("#country_code").val(254);
   }
   
    
});