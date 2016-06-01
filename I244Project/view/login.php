<?php if (!empty($errors)):?>
  <div>
  <?php foreach($errors as $e):?>
    <p style="border:1px solid #000; padding: 5px; background-color:red"><?php echo $e; ?></p>
  <?php endforeach;?>
</div>
<?php endif;?>

<form class="form-signin" action="controller.php?mode=login" method="POST">
  <h2 class="form-signin-heading">Please sign in</h2>
  <label for="inputUsername" class="sr-only">Username</label>
  <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus <?php if (!empty($_POST["username"]))
  echo "value=\"".htmlspecialchars($_POST["username"])."\" "?>>
  <label for="inputPassword" class="sr-only">Password</label>
  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <br>
</form>
<p>Not yet an user? <a href="?mode=register">Sign up!</a></p>
