<?php if (!empty($errors)):?>
  <div>
  <?php foreach($errors as $e):?>
    <p style="border:1px solid #000; padding: 5px; background-color:red"><?php echo $e; ?></p>
  <?php endforeach;?>
</div>
<?php endif;?>

<?php if (!empty($notifications)):?>
  <div>
    <?php foreach($notifications as $n):?>
      <p style="border:1px solid #000; padding: 5px; background-color:green"><?php echo $n; ?></style>
    <?php endforeach;?>
  </div>
<?php endif;?>

<form class="form-signin" action='controller.php?mode=register' method="POST">
  <h2 class="form-signin-heading">Register</h2>
  <fieldset>
    <div class="control-group">
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="form-control">
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="form-control">
      </div>
    </div>

    <div class="control-group">
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="form-control">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="forename">Forename</label>
      <div class="controls">
        <input type="text" id="forename" name="forename" placeholder="" class="form-control">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="surename">Surename</label>
      <div class="controls">
        <input type="text" id="surename" name="surename" placeholder="" class="form-control">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="usrtel">Phone number</label>
      <div class="controls">
        <input type="tel" id="usrtel" name="usrtel" placeholder="" class="form-control">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="email">E-mail address</label>
      <div class="controls">
        <input type="email" id="email" name="email" placeholder="" class="form-control">
      </div>
    </div><br>

    <div class="control-group">
      <div class="controls">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </div>
    </div><br>
  </fieldset>
</form>
