<?php
echo $url='https://www.tokendata.io/icos/upcoming?_='.time().'000';
    $data=file_get_contents_https($url);
print_r($data);die;
?>