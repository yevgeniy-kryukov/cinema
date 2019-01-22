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
        <a class="navbar-brand" href="/admin"><img src="/template/img/cinema.png" alt="" width="24" height="24"> Cinema</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo $menuItem == 'home' ? 'active' : '';?>">
              <a class="nav-link" href="/admin">Home</a>
            </li>
            <li class="nav-item <?php echo $menuItem == 'theater' ? 'active' : '';?>">
              <a class="nav-link" href="/theater">Theater</a>
            </li>
            <li class="nav-item <?php echo $menuItem == 'hall' ? 'active' : '';?>">
              <a class="nav-link" href="/hall">Hall</a>
            </li>
            <li class="nav-item <?php echo $menuItem == 'film' ? 'active' : '';?>">
              <a class="nav-link" href="/film">Film</a>
            </li>
            <li class="nav-item <?php echo $menuItem == 'show' ? 'active' : '';?>">
              <a class="nav-link" href="/show">Show</a>
            </li>
          </ul>
          &nbsp;
          <div><a class="btn btn-sm btn-success" href="/user/signout">Sign out</a></div>
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