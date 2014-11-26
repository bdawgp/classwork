<?php
  $next = $id ? $app->urlFor('picture',array('id'=>$id)) : $app->urlFor('pictures');
?>

<h2>Picture Wizard</h2>

<?php if($error): ?>
  <p style="color:#c00;"><?= $error; ?></p>
<?php endif; ?>

<form action="<?= $next; ?>" method="post" enctype="multipart/form-data">
  <p style="<?= $picture->id?'':'display:none;'; ?>">ID: <?= $picture->id; ?></p>
  <p>Title: <input type="text" name="picture[title]" value="<?= $picture->title; ?>"></p>
  <p>Date Taken: <input type="date" name="picture[date_taken]" value="<?= $picture->date_taken; ?>"></p>
  <?php if($picture->is_new_record()): ?>
    <p>Picture: <input type="file" name="image"></p>
  <?php endif; ?>

  <p><input type="submit" value="Save Picture">  <a href="<?= $next; ?>">Cancel</a></p>
</form>
