<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$ret=$kv->pkrget('', 3000);
print_r($ret);