<?php
//$json = file_get_contents('http://www.altaingenieria.cl/banos/api.php');

$options = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
        "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
        "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:20.0) Gecko/20100101 Firefox/20.0"
    )
);

$context = stream_context_create($options);
$json = file_get_contents('http://www.altaingenieria.cl/banos/api.php', false, $context);

$obj = json_decode($json);
print_r($obj);

?>
