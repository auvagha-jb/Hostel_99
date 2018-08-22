$(document).ready(function(){
   
//   $(".dropdown-content").hide();
   
   $(".dropdown").click(function(){
       $(".dropdown-content", this).slideToggle()();
   });
   
    /****************Handle window resizing**************/
    var default_width = $(window).width();
    resizeText(default_width);
    
    var min_width = 820;
   

    function resizeText(width){
        if(width<=min_width){

             $(".carousel-item h1").removeClass("display-3");
             $(".carousel-item h3").removeClass("display-4");

             $(".carousel-item h1").addClass("mobile-text");
             $(".carousel-item h3").addClass("mobile-text");
             
        }else{
             $(".carousel-item h1").addClass("display-3");
             $(".carousel-item h3").addClass("display-4");

             $(".carousel-item h1").removeClass("mobile-text");
             $(".carousel-item h3").removeClass("mobile-text");
        }
        
        
       }
    
    
    $("button#nav-btn").click(function(){
        $(".navbar-nav").slideToggle()();
    });
    
    
    $(window).resize(function(){
        var width = $(window).width();
        resizeText(width);
        console.log(width);
        
        if(width>min_width){
            $(".navbar-nav").show();
        }
    });
    
    
});