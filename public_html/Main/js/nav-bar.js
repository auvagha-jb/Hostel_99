$(document).ready(function(){
   
    //Hide and show dropdown contents
    $(".dropdown").click(function(){
       $(".dropdown-content", this).slideToggle();
   });
   
   //Collapse and expand navigation bar on small screens 
    $("button#nav-btn").click(function(){
        $(".navbar-nav").slideToggle();
    });   
    
});