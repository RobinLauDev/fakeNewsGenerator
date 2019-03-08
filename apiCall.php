<!-- bing API   -->
<!-- This API takes the input from the submitted form and returns a json object with image URL's  -->
<?php
// SUBMIT THE BING API KEY HERE BELOW IN THE ACCESKEY VARIABLE WHEN THE 7 DAY TRIAL IS OVER
$accessKey = '05076bfe43fd48a1a24582fb7bad67c2';
$endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/search';
$term = $input1;

function BingWebSearch ($url, $key, $query) {
    $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
    $options = array ('http' => array (
                          'header' => $headers,
                           'method' => 'GET'));
    $context = stream_context_create($options);
    $result = file_get_contents($url . "?q=" . urlencode($query), false, $context);
    $headers = array();
    return array($headers, $result);
}

if (strlen($accessKey) == 32) {
    list($headers, $json) = BingWebSearch($endpoint, $accessKey, $term);

    $image_json = json_encode($json);
    
} 

?>