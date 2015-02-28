<p>
  A share of <?= $stock['name'] ?> (<span id="symbol"><?= $stock['symbol'] ?></span>) costs $<span id="price"><?= $stock['price'] ?></span>.
</p>
<div id="chart"></div>
<form id="timerange">
  <input type="submit" name="5" value="5d">
  <input type="submit" name="31" value="1m">
  <input type="submit" name="91" value="3m">
  <input type="submit" name="134" value="6m">
  <input type="submit" name="ytd" value="YTD">
  <input type="submit" name="365" value="1y">
  <input type="submit" name="730" value="2y">
  <input type="submit" name="1825" value="5y">
  <input type="submit" name="3650" value="10y">
</form>
