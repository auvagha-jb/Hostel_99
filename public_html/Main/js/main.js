$(document).ready(function(){
    var width = $(window).width();   
    var min_width = 820;
    
    function resizeText(){
         
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
        
        console.log(width);
       }
    
    
    
    
    resizeText();
    
    
    $("button#nav-btn").click(function(){
        $(".navbar-nav").slideToggle('slow');
    });
    
    
    $(window).resize(function(){
        resizeText();
        if(width>min_width){
            $(".navbar-nav").show();
        }
    });
    
    
});