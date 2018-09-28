$(document).ready(function(){   
   
   function delTenant(name){   
    var del = confirm("Remove "+name+" as a tenant?");
        
        if(!del){
            return false;
        }
        else{
            return true;
        }
    }
    
    $("#remove_tenant").click(function(){
        
        var name = $(this).closest("tr").children().eq(0).text();
          return delTenant(name);
      });
    
});