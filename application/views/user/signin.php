<h1 class="h3 mb-3 font-weight-normal">Please sign in or <a href="/user/signup">sign up</a></h1>
<label for="inputEmail" class="sr-only">Email address</label>
<input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
<label for="inputPassword" class="sr-only">Password</label>
<input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required="">
<!-- 	<div class="checkbox mb-3">
<label>
    <input type="checkbox" value="remember-me"> Remember me
</label>
</div> -->
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
<?php if ($signinStatus == "AccessDenied"):  ?>
    <p style="color:red">Wrong email and / or password.</p>
<?php endif ?>