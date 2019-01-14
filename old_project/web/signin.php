<?php
require_once "../autoloader.php";

use cinema\util\Main;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cinema">
    <meta name="author" content="Yevgeniy Kryukov">
    <link rel="icon" href="img/cinema.ico">
    <title>Cinema sign in</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
    <link href="css/signin.css" rel="stylesheet">
    
    <script language="JavaScript">
		function signIn() 
    {
			var res = serv('signin_fn_ajax.php', { fn : 'signIn', email : document.getElementById("inputEmail").value, pw : document.getElementById("inputPassword").value });
			if (res > 0) window.location = "index.php";
			else alert("Error " + res);
		}
    </script>
    
  </head>
  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="img/cinema.png" alt="" width="72" height="72">
      <?php if (Main::requestGet("signUp", 0) == 1): ?>
        <h1 class="h3 mb-3 font-weight-normal">You succsessful sign up, please sign in</h1>
      <?php else: ?>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in or <a href="signup.php">sign up</a></h1>
      <?php endif ?>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="button" onClick="signIn()">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
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