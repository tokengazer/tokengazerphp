<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
//$ret=$kv->get('coinmarketproducts:1570');
$ret = $kv->pkrget('coinmarketproducts', 101);
var_dump($ret);
