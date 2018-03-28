<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$ret = $kv->get('products:600');
print_r($ret);