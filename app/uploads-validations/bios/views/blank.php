<h2>Create Bio</h2>

<?php if($error): ?>
  <p style="color: #c00;"><?= $error; ?></p>
<?php endif; ?>

<form action="<?= $app->urlFor('bios'); ?>" method="post">
  <p>Name*: <input type="text" name="bio[name]" value="<?= $bio->name; ?>"></p>
  <p>Birthday*: <input type="date" name="bio[birthday]" value="<?= $bio->birthday; ?>"></p>
  <p>Biography*: <textarea name="bio[content]"><?= $bio->content; ?></textarea></p>

  <p><input type="submit" value="Create">  <a href="<?= $app->urlFor('bios'); ?>">Cancel</a></p>
</form>
