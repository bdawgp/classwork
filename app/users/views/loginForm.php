<?php require(dirname(__FILE__).'/_miniNav.php'); ?>

<h2>Login</h2>
<form method="post">
  <?php if(isset($_GET['invalid'])): ?>
    <p style="color:#c00;">Invalid email/password combination</p>
  <?php endif; ?>
  <?php if(isset($_GET['mustLogin'])): ?>
    <p style="color:#00c;">You must login to see that</p>
  <?php endif; ?>
  <p><input type="email" name="login[email]" placeholder="your email"></p>
  <p><input type="password" name="login[password]" placeholder="•••••"></p>
  <p><input type="submit" value="Sign In">  <a href="<?= $app->urlFor('users_register'); ?>">Register</a></p>
</form>
