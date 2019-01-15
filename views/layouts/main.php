<?php //extract($dataView); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="/template/img/cinema.ico">

    <title>Cinema</title>

    <!-- Bootstrap core CSS -->
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/template/css/carousel.css" rel="stylesheet">
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/"><img src="/template/img/cinema.png" alt="" width="24" height="24"> Cinema</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/site/about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/site/contact">Contact</a>
            </li>
          </ul>
          &nbsp;
          <form action="/" method="post" class="form-inline mr-5">
            <div class="form-group">
              <label class="text-light" for="category">Find</label>
              <select class="form-control-sm mx-2" name="category" id="category" size="1">
                <option value="*" <?php echo $idCat == "*" ? "selected" : ""; ?>>Any Category</option>
                  <?php foreach ($listCat as $itemCat): 
                      if ($itemCat["id"] == $idCat) {
                          $sel = "selected";
                      } else {
                          $sel = "";
                      }
                      ?>
                  <option value="<?php echo $itemCat["id"]; ?>" <?php echo $sel; ?>><?php echo $itemCat["categoryname"]; ?></option>
                  <?php endforeach ?>
              </select>
              <label class="text-light" for="rating">movies rated</label>
              <select class="form-control-sm  mx-2" name="rating" id="rating" size="1">
                <option value="*" <?php echo $rating == "*" ? "selected" : ""; ?>>Any rating</option>
                <option <?php echo $rating == "G" ? "selected" : ""; ?>>G</option>
                <option <?php echo $rating == "PG" ? "selected" : ""; ?>>PG</option>
                <option <?php echo $rating == "PG-13" ? "selected" : ""; ?>>PG-13</option>
                <option <?php echo $rating == "R" ? "selected" : ""; ?>>R</option>
              </select>
              <button class="btn btn-sm btn-info" type="submit">Go!</button>
            </div>
          </form>
          &nbsp;
          <?php if ($idUser == 0): ?>
            <div><a class="btn btn-sm btn-primary" href="/user/signin">Sign in</a></div>
          <?php else: ?>
            <div class="dropdown">
              <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $emailUser; ?>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/order">orders</a>
                <a class="dropdown-item" href="/user/signout">sign out</a>
              </div>
            </div>
          <?php endif ?>
        </div>
      </nav>
    </header>

    <main role="main">
		<?php include 'views/' . $contentView; ?>
    </main>

	  <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2018-2019 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/template/js/jquery-3.3.1.min.js"></script>
    <script src="/template/js/popper.min.js"></script>
    <script src="/template/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="/template/js/holder.min.js"></script>
    <script language="JavaScript" type="text/JavaScript" src="/template/js/myAjax.js"></script>
  </body>
</html>