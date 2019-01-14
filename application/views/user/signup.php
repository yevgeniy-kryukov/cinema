<h1 class="h3 mb-3 font-weight-normal">Please sign up or <a href="/user/signin">sign in</a></h1>
<label for="inputEmail" class="sr-only">Email address</label>
<input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
<label for="inputPassword" class="sr-only">Password</label>
<input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required="">
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
<?php if ($signupStatus == "EmailDuplicate"):  ?>
    <p style="color:red">User with such email already exists.</p>
<?php elseif ($signupStatus == "UnknownError"):  ?>
    <p style="color:red">Unknown error.</p>
<?php endif ?>