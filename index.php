<?php
	require_once("model/DataBase.php");
	require_once("model/UtilsMain.php");
	require_once("model/FilmCategory.php");
  require_once("model/Film.php");
  
  $link = DataBase::dbConnect();

  $resultCatList = FilmCategory::categoryList($link);
  
  $catName = "";
  $catID = UtilsMain::requestGet("category");
  if ($catID == "") $catID = UtilsMain::requestGetCookie("cacheCinemaLastCategory", "*");  // Если запроса от пользователя еще не было, то используем куки.
  if ($catID != "*") $catName = FilmCategory::categoryName($catID, $link);

  $rating = UtilsMain::requestGet("rating","*");
  $resultTop = Film::topFilms($catID, $rating, $link);

  pg_close($link);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="img/favicon.ico">

    <title>Cinema</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Cinema</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <!--<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">-->

            <label class="text-light" for="category">Find</label>
            <select class="form-control mx-2" name="category" id="category" size="1">
              <option value="*" <?php echo $catID == "*" ? "selected" : ""; ?>>Any Category</option>
              <?php for($ii = 0; $ii < count($resultCatList); $ii++): 
                  $rowCatList = $resultCatList[$ii];
                  if ($rowCatList["id"] == $catID) $sel = "selected";
                  else $sel = "";
              ?>
                <option value="<?php echo $rowCatList["id"]; ?>" <?php echo $sel; ?>><?php echo $rowCatList["categoryname"]; ?></option>
              <?php endfor ?>
            </select>

            <label class="text-light" for="rating">movies rated</label>
            <select class="form-control  mx-2" name="rating" id="rating" size="1">
              <option value="*" <?php echo $rating == "*" ? "selected" : ""; ?>>Any rating</option>
              <option <?php echo $rating == "G" ? "selected" : ""; ?>>G</option>
              <option <?php echo $rating == "PG" ? "selected" : ""; ?>>PG</option>
              <option <?php echo $rating == "PG13" ? "selected" : ""; ?>>PG-13</option>
              <option <?php echo $rating == "R" ? "selected" : ""; ?>>R</option>
            </select>

            <button class="btn btn-info my-2 my-sm-0" type="submit">Go!</button>
            <!--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
          </form>
        </div>
      </nav>
    </header>

    <main role="main">
      <h1 class="text-center my-2">Today's <?php echo $catName; ?> Top Picks</h1>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <?php for($ii = 1; $ii <= 3; $ii++):
            $rowTop = $resultTop[$ii];
        ?>
          <div class="carousel-item <?php echo $ii == 1 ? "active" : ""; ?>">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="<?php echo $ii; ?> slide">
            <div class="container">
              <div class="carousel-caption <?php if ($ii == 1) echo "text-left"; elseif ($ii == 3) echo "text-right"; ?>">
                <h1><?php echo $rowTop["title"]; ?></h1>
                <p><?php echo $rowTop["description"]; ?></p>
                <p>Genre <span class="font-weight-bold"><?php echo $rowTop["categoryname"]; ?></span> Length <span class="font-weight-bold"><?php echo $rowTop["length"]; ?> minutes</span> rating <span class="font-weight-bold"><?php echo $rowTop["rating"]; ?></span>.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Buy a ticket</a></p>
              </div>
            </div>
          </div>
        <?php endfor ?>
        </div>

<!--         <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
            <div class="container">
              <div class="carousel-caption">
                <h1>Another example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
            <div class="container">
              <div class="carousel-caption text-right">
                <h1>One more for good measure.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
              </div>
            </div>
          </div>
        </div> -->
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>


      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <?php       
          for($ii = 3; $ii < count($resultTop); $ii++):
            $rowTop = $resultTop[$ii];
            if ($ii%2 == 0) {
                $orderMD7 = "order-md-2";
                $orderMD5 = "order-md-1";
            } else {
                $orderMD7 = "";
                $orderMD5 = "";
            }
        ?>
        <div class="row featurette">
          <div class="col-md-7 <?=$orderMD7;?>">
            <h2 class="featurette-heading"><?php echo $rowTop["title"]; ?>.</h2>
            <p class="lead"><?php echo $rowTop["description"]; ?>.</p>
            <p>Genre <span class="font-weight-bold"><?php echo $rowTop["categoryname"]; ?></span> Length <span class="font-weight-bold"><?php echo $rowTop["length"]; ?> minutes</span> rating <span class="font-weight-bold"><?php echo $rowTop["rating"]; ?></span>.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Buy a ticket</a></p>
          </div>
          <div class="col-md-5 <?=$orderMD5;?>">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>
        <hr class="featurette-divider">
        <?php endfor ?>

<!--         <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>
 -->
<!--         <hr class="featurette-divider"> -->

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->


      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
  </body>
</html>
