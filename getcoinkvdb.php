<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$ret=$kv->pkrget('', 1700);
print_r($ret);