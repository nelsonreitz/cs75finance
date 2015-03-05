<div class="quote">
  <h2>
    <?= $stock['name'] ?> (<span id="symbol"><?= $stock['symbol'] ?></span>):
    $<span id="price"><?= $stock['price'] ?></span>
  </h2>
</div><!-- quote -->

<div class="history">
  <div id="chart">
  </div><!-- #chart -->
  <form id="timerange">

    <?php foreach ($ranges as $range => $days): ?>
        <input type="submit" name="<?= $days ?>" value="<?= $range ?>">
    <?php endforeach ?>

  </form>
</div><!-- .history -->

<div class="headlines">
  <h2>Headlines</h2>
  <ul>

    <?php foreach ($headlines->channel->item as $item): ?>

        <li>
          <a class="headline-title" href="<?= $item->link ?>"><?= $item->title ?></a>
          <span class="headline-date"><?= $item->pubDate ?></span>
        </li>

    <?php endforeach ?>

  </ul>
</div><!-- .headlines -->
