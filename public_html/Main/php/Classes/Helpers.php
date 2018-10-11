<?php

class Helpers{
    
    public function alert($msg){
        echo '
            <script>
                alert("'.$msg.'");
            </script>
        ';
    }
    
}
