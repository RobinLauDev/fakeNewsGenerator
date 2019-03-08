require 'vendor/autoload.php';


$client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false ),'verify' => false));
$res = $client->post('https://api.remove.bg/v1.0/removebg', [
    'multipart' => [
        [
            'name'     => 'image_url',
            'contents' => 'https://vice-images.vice.com/images/content-images/2016/07/04/what-your-facebook-profile-photo-says-about-you-body-image-1467635168.jpg?output-quality=75?resize=320:*'
        ],
        [
            'name'     => 'size',
            'contents' => 'regular'
        ]
    ],
    'headers' => [
        'X-Api-Key' => 'nQGpqJCwa5yP6E6kLzFFF6tt'
    ]
]);




$fp = fopen("Persons/pieter.png", "wb");
fwrite($fp, $res->getBody());
fclose($fp);