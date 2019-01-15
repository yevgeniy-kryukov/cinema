<?php if ($signupResult):  ?>
    <h1>You have successfully sign up, please <a href="/user/signin">sign in</a></h1>
<?php else: ?>
    <?php if (is_array($signupErrors)):  ?>
        <ul class="text-left">
            <?php foreach ($signupErrors as $error): ?>
                <li> - <?php echo $error; ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
    <h1 class="h3 mb-3 font-weight-normal">Please sign up or <a href="/user/signin">sign in</a></h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" value="<?php echo $signupEmail; ?>">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required="">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
<?php endif ?>