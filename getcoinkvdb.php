<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$ret=$kv->get('product:1570');
print_r($ret);
