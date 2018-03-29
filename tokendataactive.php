<?php
echo $url='https://www.tokendata.io/icos/active?_='.time().'000';
    $data=file_get_contents($url);
print_r($data);
?>