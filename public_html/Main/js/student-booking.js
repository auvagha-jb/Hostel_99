$(document).ready(function(){
    
    $("#checkout").hid
    
    $("#pick_room").click(function(){
        var gender = $("#gender").val();
        var no_sharing = $("#no_sharing").val();
        getAvailableRooms(gender, no_sharing);  
    });
    
    $(document).on("click",".modal-body .card", function(){
        var room = $(this).attr("id");
        $("#room_chosen").val(room);
        //Set the link dynamically
        var a = document.getElementById('checkout');
        a.href="checkout.php?room="+room;
        $("#checkout").show();
    });
    
     function getAvailableRooms(gender, no_sharing){
        var action = "get_available";
        $.post("php-owner/owner-get-room-details.php",{gender:gender, no_sharing:no_sharing, action:action},function(data){
            $("#pick-rm-dialog .row").html(data);
            $("#pickRoom").modal('show');
        });
    }
    
    function updateCartItem(obj,id){
        $.get("./cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data === 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    
});