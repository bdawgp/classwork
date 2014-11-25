<a href="<?= $app->urlFor('new_hobbit'); ?>">+ Create New Hobbit</a>
<ul>
  <?php foreach($hobbits as $hobbit): ?>
    <li>
      <a href="<?= $app->urlFor('hobbit',array('id'=>$hobbit->id)); ?>">
        <?= $hobbit->name; ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
