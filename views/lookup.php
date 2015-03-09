<div class="quote">
  <h2>
    <?= $stock['name'] ?> (<span id="symbol"><?= $stock['symbol'] ?></span>):
    $<span id="price"><?= $stock['price'] ?></span>
  </h2>
</div><!-- quote -->

<div class="history">
  <form id="timerange">

    <?php foreach ($ranges as $range => $days): ?>
        <input type="submit" name="<?= $days ?>" value="<?= $range ?>">
    <?php endforeach ?>

  </form>
  <div id="chart">
  </div><!-- #chart -->
</div><!-- .history -->

<div class="headlines">
  <h2>Headlines</h2>
  <ul>

    <?php foreach ($headlines->channel->item as $item): ?>

        <li>
          <a class="headline-title" href="<?= htmlspecialchars($item->link) ?>">
            <?= htmlspecialchars($item->title) ?>
          </a>
          <span class="headline-date"><?= htmlspecialchars($item->pubDate) ?></span>
        </li>

    <?php endforeach ?>

  </ul>
</div><!-- .headlines -->
