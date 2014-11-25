<h2>Bios</h2>
<a href="<?= $app->urlFor('new_bio'); ?>">New Bio</a>

<ul>
  <?php foreach($bios as $bio): ?>
    <li>
      <a href="<?= $app->urlFor('bio',array('id' => $bio->id)); ?>"><?= $bio->name; ?></a>
      <small>(born on <?= $bio->birthday; ?>)</small>
    </li>
  <?php endforeach; ?>
</ul>
