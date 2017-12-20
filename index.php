<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- start meta tags -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- end meta tags -->
      
      <!-- start Microsoft internet explorer support -->
      <!--[if It IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
      <!-- end Microsoft internet explorer support -->
      
      <!-- start Application title -->
      <title>TeraPixel</title>
      <!-- end Application title -->
      
      <!-- start Application CSS files -->
      <link rel="stylesheet" href="css/bootstrap.min.css"/><!-- Bootstrap -->
      <link rel="stylesheet" href="css/application.css"/><!-- Application Custom CSS -->
      <link rel="icon" href="icon/appicon.ico"/><!-- Application Icon -->
      <!-- end Application CSS files -->
  </head>
  <body>
      <!-- start navbar -->
      <nav id="brand">
          <div class="container">
                <img src="icon/appicon.ico">
                <h2 class="heading">TeraPixel</h2>
          </div>
      </nav>
      <!-- end navbar -->
      
      <!-- start image select section -->
      <section id="image-select">
          <div class="container"><!-- start container -->
            <div class="wrapper"><!-- start wrapper -->
                <form action='./application/application.php' method="POST" enctype="multipart/form-data" id="my-form"><!-- start select image and ratio form -->
                    <!-- start select image from device -->
                    <label class="title">Select Image From File:</label><!-- label for input field -->
                      
                    <input type="file" name="img_to_compress" id="upload" class="form-control mb-4" accept="image/*"/>
                      <!-- end select image from device -->
                      
                      <!-- start select compression ratio -->
                      <label class="title">Select Compression Ratio:</label><!-- label for input field -->
                      <select name="ratio" class="form-control mb-4">
                          <!-- start compression values -->
                            <option value="90">90%</option>
                            <option value="80">80%</option>
                            <option value="70">70%</option>
                            <option value="60">60%</option>
                            <option value="50">50%</option>
                            <option value="40">40%</option>
                            <option value="30">30%</option>
                          <!-- end compression values -->
                      </select>
                      <!-- end select compression ratio -->
                      
                      <div class="text-center">
                          <input type="submit" class="btn" value="Compress Now"/><!-- proceed button -->
                      </div>
      
                  </form><!-- end select image and ratio form -->  
            </div><!-- end wrapper -->
          </div><!-- end container -->          
      </section>
      <!-- end image select section -->
      
      <!-- start adding js files -->
      <script src="js/jquery-3.2.0.min.js"></script><!-- jQuery JS -->
      <script src="js/bootstrap.min.js"></script><!-- Bootstrap JS -->
  </body>
</html>