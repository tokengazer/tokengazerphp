<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
//$ret=$kv->get('coinmarketproducts:1570');
$ret = $kv->pkrget('coinmarketproducts', 100);
var_dump($ret);
