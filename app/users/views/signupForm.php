<?php require(dirname(__FILE__).'/_miniNav.php'); ?>

<h2>Register</h2>
<form method="post">
  <p>Name: <input type="text" name="user[name]" placeholder="full name"></p>
  <p>Email: <input type="email" name="user[email]" placeholder="valid email"></p>
  <p>Password: <input type="password" name="user[password]" placeholder="wicked password"></p>
  <p><input type="submit" value="Create Account"> <a href="<?= $app->urlFor('users_login'); ?>">Cancel</a></p>
</form>
