<?php //extract($dataView);?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="/template/img/cinema.ico">
    <title>Cinema sign</title>

    <!-- Bootstrap core CSS -->
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="/template/css/sign.css" rel="stylesheet">
    
  </head>
  <body class="text-center">
    <form class="form-sign" method="post">
      <img class="mb-4" src="/template/img/cinema.png" alt="" width="72" height="72">
      <?php include 'views/' . $contentView; ?>
      <p class="mt-5 mb-3 text-muted">© 2018-2019</p>
    </form>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
	  <script language="JavaScript" type="text/JavaScript" src="js/myAjax.js"></script>
</body>
</html>