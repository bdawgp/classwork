<?php
  $next = $id ? $app->urlFor('hobbit',array('id'=>$id)) : $app->urlFor('hobbits');
?>

<h2>Hobbit Wizard</h2>
<form action="<?= $next ?>" method="post">
  <?php if($hobbit->id){ echo 'ID: '.$hobbit->id; } ?>
  <div>Name: <input type="text" name="hobbit[name]" value="<?= $hobbit->name; ?>"></div>
  <input type="submit">
</form>
<a href="<?= $next; ?>">Cancel</a>
