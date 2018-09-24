<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>jQuery Ajax File Uploader Widget</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/jquery.dm-uploader.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
  </head>

  <body>

    <?php 
        $hostel_name = $_GET['hostel_name'];
        $_SESSION['hostel_name'] = $hostel_name;
    ?>
    <div class="container">

      <h1>My images</h1>
        
      <div class="row">
        <div class="col-md-6">
          
          <div id="drag-and-drop-zone" class="dm-uploader p-5">
            <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop images here</h3>

            <div class="btn btn-primary btn-block mb-5">
                <span>Open the file Browser</span>
                <input type="file" title='Click to add Files' />
            </div>
          </div>

        </div>
        <div class="col-md-6">
          <div class="card h-100">
            <div class="card-header">
              File List
            </div>

            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
              <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="card h-100">
            <div class="card-header">
              Debug Messages
            </div>

            <ul class="list-group list-group-flush" id="debug">
              <li class="list-group-item text-muted empty">Loading plugin....</li>
            </ul>
        </div>

    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dm-uploader.min.js"></script>
    <script src="js/demo-ui.js"></script>
    <script src="js/demo-config.js"></script>
    <script src="js/owner-upload.js"></script>

    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
    
        <img class="mr-3 mb-2 preview-img" src="https://danielmg.org/assets/image/noimage.jpg?v=v10" alt="Generic placeholder image">

        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>

          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
  </body>
</html>
