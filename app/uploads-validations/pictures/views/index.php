<h2>Pictures</h2>
<a href="<?= $app->urlFor('new_picture'); ?>">New Picture</a>


<p id="pictures">
  <?php foreach($pictures as $picture): ?>
    <a class="picture" href="<?= $app->urlFor('picture',array('id' => $picture->id)); ?>">
      <img src="<?= $app->urlFor('root').$picture->file_path; ?>" alt="<?= $picture->id; ?>">
    </a>
  <?php endforeach; ?>
</p>
