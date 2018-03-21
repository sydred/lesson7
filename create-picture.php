<?php
header('Content-type: image/png');
$testname = $_POST['testname'];
$username = $_POST['username'];
$date = $_POST['date'];
$correctAnswers = $_POST['correctAnswers'];
$totalAnswers = $_POST['totalAnswers'];
$correct = $correctAnswers . ' из ' . $totalAnswers;
$img = imagecreatefromjpeg('img/picture.jpg');
$white = imagecolorallocate($img,255,255,255);
$imageWidth = getimagesize('img/picture.jpg');
$imageWidth = $imageWidth[0];
$textPoints = imagettfbbox(300, 0, 'font.ttf', $username);
$textWidth = $textPoints[2] - $textPoints[0];
$x = ($imageWidth - $textWidth) / 2;
imagettftext($img, 300, 0, $x, 600, $white, 'font.ttf', $username . ',');
imagettftext($img, 200, 0, 1600, 1625, $white, 'font.ttf', $testname);
imagettftext($img, 180, 0, 1600, 1976   , $white, 'font.ttf', $correct);
imagettftext($img, 180, 0, 1600, 2325, $white, 'font.ttf', $date);
imagepng($img);
imagedestroy($img);