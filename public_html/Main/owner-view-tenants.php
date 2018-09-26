<!DOCTYPE HTML>
<html>
    <head>
        <title>My tenants</title>
        <?php include_once './links.php';?>
        <link rel="stylesheet" href="css/owner-forms.css">
        <script src="js/add-tenants.js"></script>
    </head>
<body>

    <div class="m-auto">
        <center class="lead title">Add Tenants</center>
    <form class="form-inline justify-content-center" method="post" id="search-form">
        <input class="form-control mx-2" name="email" id="email" placeholder="User ID" required="">
          
            <div class="input-group mx-2">
                <input class="form-control" name="room_no" id="room_no" placeholder="Room assigned">
                <div class="input-group-append">
                    <button type="button" class="btn btn-success form-control" name="search_submit" id="add_tenant">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
    </form>
    
        <div id="test"></div>
        
    <div>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
        
</div>
    
</body>
</html>