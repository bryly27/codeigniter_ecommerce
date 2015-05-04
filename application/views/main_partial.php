<?php
  foreach ($products as $product)
  { ?>
    <div class="span3 product">
      <a href="/detail/index/<?= $product['id'] ?>"><img src="<?= $product['photo'] ?>">
      <p><?= $product['name'] ?></p>
      <p><?= $product['price'] ?></p>
      <p><a class="btn" href="/detail/index/<?= $product['id'] ?>">View details &raquo;</a></p></a>
    </div>
<?php
  }
?>