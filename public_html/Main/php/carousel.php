<div class="carousel-inner">
      <?php //Set hostel_name session variable
    $_SESSION['hostel_name'] = $_GET['hostel_name'];

    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }


      $folder = "uploads/";
      $hostel_name = $_SESSION['hostel_name']."/";
      
      $path = $folder.$hostel_name;
      
      if(file_exists($path)){
          
          $handle = opendir($path);
          $first = true;
          $counter = 0;

          while($file = readdir($handle)){
              if($file !=='.' && $file !== ".."){

              if($first){
                echo '
                 <div class="carousel-item active">
                    <img src="'.$folder.$hostel_name.$file.'">
                </div>
               ';

                $first = false;
              }  else {
                      echo '
                     <div class="carousel-item">
                        <img src="'.$folder.$hostel_name.$file.'">
                    </div>
                   ';
              }
              $counter++;
          }
          }
    }
      ?>
  </div>