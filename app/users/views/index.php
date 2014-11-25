<h2>Welcome <?= $user->name; ?></h2>
<?php if(isset($_GET['success'])): ?>
  <p style="color:#0c0;">Login was successful</p>
<?php endif; ?>
<p>The secret is: I know the muffin man...</p>
<form action="<?= $app->urlFor('users_login'); ?>" method="post">
  <input type="hidden" name="_METHOD" value="DELETE">
  <input type="submit" value="Logout">
</form>
