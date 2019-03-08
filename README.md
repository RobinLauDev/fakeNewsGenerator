# fakeNewsGenerator

This tool makes use of the bing API which requires a licensing key. 

*whispers* but free keys or usable for 7 days which after you can just use a different email adres to get another free key for 7 days *wispers*

These license keys are stored in the bingApi.php file

--------------------------------
Adding sentence formats

formHandle.php contains the arrays in which content can be added, just make sure you also include a fitting image in the if else statements below:

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


