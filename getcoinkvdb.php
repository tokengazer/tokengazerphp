<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$ret = $kv->pkrget('products:',1500);
var_dump($ret);