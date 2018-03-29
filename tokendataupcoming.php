<?php
$url='https://www.tokendata.io/icos/upcoming?_='.time().'000';
    $data=file_get_contents($url);
print_r($data);
?>