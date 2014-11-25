<p>
  <a href="<?= $app->urlFor('hobbits'); ?>">All Hobbits</a>
</p>
<h2><?= $hobbit->name; ?></h2>
<div>
  <a href="<?= $app->urlFor('edit_hobbit',array('id'=>$id)); ?>">Edit</a>

  <form method="post" style="display:inline-block;" onsubmit="return confirm('You are deleting this hobbit. It cannot be undone');">
    <input type="hidden" name="_METHOD" value="DELETE">
    <input type="submit" value="delete">
  </form>
</div>
