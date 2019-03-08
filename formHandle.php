<?php
//takes the value from the submitted form 
$input1 = $_POST['group1'];

//include bing API that takes input1 POST vavlue and returns a json list of related image URL's
include 'apiCall.php';


//Sentence format arrays----------------------------------------------------------------------------------------------------
$template1  = array("Dem darling Ocasio-Cortez says there is a ‘legitimate question’ that needs to be asked: ‘Is", "still okay?");
$template2  = array("Trump:", "is a very important part of true american culture and I won’t let the dems ruin this again!");
$template3  = array("Democrats looking to tax", "because of possible global warming?");

$arrayArray = array($template1, $template2, $template3);

//chooses random array
$random = array_rand($arrayArray, 1);
$gekozenZin = $arrayArray[$random];

//capitalize input for headline
$inputCap = strtoupper($input1);

if($random == 0){
    $personLink = 'person/cortez.png';
    $imageText = "AOC MISINFORMED ABOUT " . $inputCap;
}
if($random == 1){
    $personLink = 'person/trump.png';
    $imageText = "DEFENDING " . $inputCap;
}
if($random == 2){
    $personLink = 'person/bernie.png';
    $imageText = "CRAZY BERNIE ON " . $inputCap;
}

//creates a src link from the images to place into the foxnews div
$link1 = '<div class="personDiv" style="background-image:url(';
$link2 = ');background-size:contain;background-repeat:no-repeat;background-position:center;"></div>';
$heleZin = $link1.$personLink.$link2;

$zin = $gekozenZin[0] . " " . $input1 . " " . $gekozenZin[1];


//BACKGROUND REMOVAL API, works via guzzle http client is not actually used in this latest version because the customer wanted fox news relevant persons---------------------------------------------------------
//this require is needed for a guzzle data submit
require 'vendor/autoload.php';

function apiCallEen(){
$client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false ),'verify' => false));
$res = $client->post('https://api.remove.bg/v1.0/removebg', [
    'multipart' => [
        [
            'name'     => 'image_url',
            'contents' => 'https://cdn1.thr.com/sites/default/files/imagecache/NFE_portrait/2018/08/dora_the_explorer_-_screengrab_-_p_2018.jpg'
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

$rootFolderCombined1 = "person/" . $_POST['group1'] . ".png";
$fp = fopen($rootFolderCombined1, "wb");
fwrite($fp, $res->getBody());
fclose($fp);
}


function apiCallTwee(){
$client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false ),'verify' => false));
$res = $client->post('https://api.remove.bg/v1.0/removebg', [
    'multipart' => [
        [
            'name'     => 'image_url',
            'contents' => 'https://historiek.net/wp-content/uploads-phistor1/2016/07/Adolf-Hitler-e1467578847248.jpg'
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

$rootFolderCombined2 = "person/" . $_POST['group2'] . ".png";
$fp = fopen($rootFolderCombined2, "wb");
fwrite($fp, $res->getBody());
fclose($fp);
}

?>


<!-- This next HTML and javascript is all needed for the manipulation of the foxnews live website_________________________________________ -->
<!DOCTYPE html>
<html lang="nl">

<head>
<link href="style.css" rel="stylesheet" type="text/css" />

<script>	
//the json object from bing API into a javascript variable
var gen = <?php  echo json_decode($image_json); ?>;

//image text php variable into javascript so we can display it into the div
var imageTextt = '<?php  echo ($imageText); ?>';

//randomize a value so we can get a random image url from the list of image objects
var randomNr = Math.floor(Math.random() * 10) + 1 ;
var inputString = gen.images.value[randomNr].contentUrl;

$(document).ready(function() {
    //remove last entry in persondiv
    $(".personDiv").remove();
    var elem = $(".collection.collection-spotlight").next().find("article").first();

    //ehco the randomized sentence into the headline inner html
    elem.find("h2").find("a").html("<?php echo $zin;?>");
    //replace the source element url with the bing API url 
    elem.find("picture").find("source").attr("srcset", inputString);
    elem.find("picture").css("display", "block");

    $(function() {
        //match height library is used here to match the height of the images
        $(".collection.collection-spotlight").eq( 1 ).find(".content").find("img").matchHeight({
            target: $(".collection.collection-spotlight").find(".content").find("img").eq( 3 )
        });

        //Object-fit cover for better image quality
        $(".collection.collection-spotlight").eq( 1 ).find(".content").find("img").css("object-fit", "cover");

        //Remove discriptive part of content
        $(".collection.collection-spotlight").eq( 1 ).find(".content").find(".info").find(".content").css("display", "none");
        
        //echo the img src url into the div that shows the fox news relevent person, like Trump, Bernie or AOC
        var personDiv = '<?php echo $heleZin ?>';
        $(".collection.collection-spotlight").eq( 1 ).find("picture").append(personDiv);

        //here we change the image text to the short description
        $(".collection.collection-spotlight").eq( 1 ).find("article").eq( 0 ).find(".kicker").find("span").html(imageTextt);
    });
});
</script>
</head> 	
<body>
</body>
</html>
