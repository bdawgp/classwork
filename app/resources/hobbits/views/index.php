<a href="<?= $app->urlFor('new_hobbit'); ?>">+ Create New Hobbit</a>
<?php if($hobbits): ?>
  <table>
    <tr>
      <th>
        <a href="?col=id&dir=<?= ($col == 'id' && $asc>0)?'desc':'asc'; ?>">ID</a>
      </th>
      <th>
        <a href="?col=name&dir=<?= ($col == 'name' && $asc>0)?'desc':'asc'; ?>">Name</a>
      </th>
    </tr>
    <?php foreach($hobbits as $hobbit): ?>
      <tr>
        <td style="width:50px;text-align:center;"><?= $hobbit->id; ?></td>
        <td>
          <a href="<?= $app->urlFor('hobbit',array('id' => $hobbit->id)); ?>">
            <?= $hobbit->name; ?>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>
