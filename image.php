
<?php
$binEqual = [
    file_get_contents('https://db6wg66ahfje1.cloudfront.net/16/02/22/f401dc5d.jpg')
];

$binDiff = [
    file_get_contents('http://cdn0-a.production.images.static6.com/ixH_FBzB3dadO6tiUmc6I3Z4Jkw=/640x355/smart/filters:quality(75):strip_icc():format(jpeg)/liputan6-media-production/medias/1149891/original/014267100_1456136684-mobil_manor.jpg'),
];


function getAvgColor($bin, $size = 10) {

    $target = imagecreatetruecolor($size, $size);
    $source = imagecreatefromstring($bin);

    imagecopyresized($target, $source, 0, 0, 0, 0, $size, $size, imagesx($source), imagesy($source));

    $r = $g = $b = 0;

    foreach(range(0, $size - 1) as $x) {
        foreach(range(0, $size - 1) as $y) {
            $rgb = imagecolorat($target, $x, $y);
            $r += $rgb >> 16;
            $g += $rgb >> 8 & 255;
            $b += $rgb & 255;
        }
    }   

    unset($source, $target);

    return (floor($r / $size ** 2) << 16) +  (floor($g / $size ** 2) << 8)  + floor($b / $size ** 2);
}

function compAvgColor($c1, $c2, $tolerance = 4) {

    return abs(($c1 >> 16) - ($c2 >> 16)) <= $tolerance && 
           abs(($c1 >> 8 & 255) - ($c2 >> 8 & 255)) <= $tolerance &&
           abs(($c1 & 255) - ($c2 & 255)) <= $tolerance;
}


    var_dump(compAvgColor(getAvgColor($binEqual[0]), getAvgColor($binDiff[0])));

?>