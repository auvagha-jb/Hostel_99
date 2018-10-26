<html>
    <head>
        <title>Test</title>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<!--    <link rel="stylesheet" href="css/owner-table.css">-->
    <?php include './links.php'; ?>
<link rel="stylesheet" href="css/owner-table.css">
<script src="js/owner-table.js"></script>
<style>
    #edit-feedback{
        display: none;
    }
</style>
<script>
    $(document).ready(function(){
       updateSuccess();
       
       function updateSuccess(){
           $("#edit-feedback").slideDown().delay(1500).slideUp();
       }
       
    });
</script>
    </head>
    <body>
        <center id="edit-feedback" class="alert alert-success">Details Updated</center>
    </body>
</html>