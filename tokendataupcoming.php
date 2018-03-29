<?php
$url='https://www.tokendata.io/icos/upcoming?_='.time().'000';
    $data=file_get_contents_https($url);
echo print_r($data);die;
?>