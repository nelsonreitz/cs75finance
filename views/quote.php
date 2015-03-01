<p>
  A share of <?= $stock['name'] ?> (<span id="symbol"><?= $stock['symbol'] ?></span>) costs $<span id="price"><?= $stock['price'] ?></span>.
</p>

<div id="chart"></div>

<form id="timerange">

  <?php foreach ($ranges as $range => $days): ?>
      <input type="submit" name="<?= $days ?>" value="<?= $range ?>">
  <?php endforeach ?>

</form>

<ul>

  <?php foreach ($headlines->channel->item as $item): ?>

      <li>
        <a href="<?= $item->link ?>">
          <?= $item->title ?>
        </a>
        <p><?= $item->pubDate ?></p>
      </li>

  <?php endforeach ?>

</ul>
