<div class="quote">
  <p>
    A share of <?= $stock['name'] ?> (<span id="symbol"><?= $stock['symbol'] ?></span>)
    costs $<span id="price"><?= $stock['price'] ?></span>.
  </p>
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
</div><!-- .headlines -->
