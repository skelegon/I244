<form class="form-horizontal" action='' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Register</legend>
    </div>
    <div class="control-group">
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="forename">Forename</label>
      <div class="controls">
        <input type="text" id="forename" name="forename" placeholder="" class="input-xlarge">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="surename">Surename</label>
      <div class="controls">
        <input type="text" id="surename" name="surename" placeholder="" class="input-xlarge">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="usrtel">Phone number</label>
      <div class="controls">
        <input type="tel" id="usrtel" name="usrtel" placeholder="" class="input-xlarge">
      </div>
    </div><br>

    <div class="control-group">
      <label class="control-label"  for="email">E-mail address</label>
      <div class="controls">
        <input type="e-mail" id="email" name="email" placeholder="" class="input-xlarge">
      </div>
    </div><br>

    <div class="control-group">
      <div class="controls">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </div>
    </div><br>
  </fieldset>
</form>


<!-- Print out errors -->
<?php if (!empty($errors)):?>
  <?php foreach($errors as $e):?>
    <p style="color:red"><?php echo $e; ?></style>
  <?php endforeach;?>
<?php endif;?>


<!-- Print out notifications -->
<?php if (!empty($notifications)):?>
  <?php foreach($notifications as $n):?>
    <p style="color:green"><?php echo $n; ?></style>
  <?php endforeach;?>
<?php endif;?>
