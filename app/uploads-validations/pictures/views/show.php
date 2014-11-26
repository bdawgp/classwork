<h2>Picture: <?= $picture->title; ?></h2>
<p>
  <img src="<?= $app->urlFor('root').$picture->file_path; ?>" alt="<?= $picture->id; ?>" style="width:100%;">
  <br> <small>Taken on: <?= $picture->date_taken; ?></small>
</p>
