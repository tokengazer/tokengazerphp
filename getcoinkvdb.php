<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
$ret = $kv->get('products:1500');
print_r($ret);