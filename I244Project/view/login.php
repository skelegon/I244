<form class="form-signin" action="controller.php?mode=login" method="POST">
  <h2 class="form-signin-heading">Please sign in</h2>
  <label for="inputUsername" class="sr-only">Username</label>
  <input name="username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus <?php if (!empty($_POST["username"]))
  echo "value=\"".htmlspecialchars($_POST["username"])."\" "?>>
  <label for="inputPassword" class="sr-only">Password</label>
  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <div class="checkbox">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <br>
</form>
<?php if (!empty($errors)):?>
  <?php foreach($errors as $e):?>
    <p style="color:red"><?php echo $e; ?></style>
  <?php endforeach;?>
<?php endif;?>
