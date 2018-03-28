<?php
$kv = new SaeKV();
$ret = $kv->init("xowlw2kmk2");
//$ret=$kv->get('coinmarketproducts:1570');
$ret = $kv->pkrget('', 100);
while (true) {
   var_dump($ret);
   end($ret);
   $start_key = key($ret);
   $i = count($ret);
   if ($i < 100) break;
   $ret = $kv->pkrget('', 100, $start_key);
}
print_r($ret);
