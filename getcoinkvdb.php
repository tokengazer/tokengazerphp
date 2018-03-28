<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$ret = $kv->get('products:400');
print_r($ret);