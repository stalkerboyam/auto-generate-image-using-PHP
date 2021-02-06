<?php


$background_path = 'assets/grey.jpg';
$avatar_path = 'assets/avatar.png';
$right_side_path = 'assets/right.png';
$badge_path = 'assets/badge.jpg';

$background_image = imagecreatefromjpeg($background_path);
$avatar_image = imagecreatefrompng($avatar_path);
$right_side_image = imagecreatefrompng($right_side_path);
$badge_image = imagecreatefromjpeg($badge_path);

list($img2_width, $img2_height) = getimagesize($avatar_path);
list($img1_width, $img1_height) = getimagesize($background_path);
list($img3_width, $img3_height) = getimagesize($right_side_path);
list($img4_width, $img4_height) = getimagesize($badge_path);

$avatar_size = array('width'=>125,'height'=>125);
$right_side_size = array('width'=>500,'height'=>700);
$background_size = array('width'=>1200,'height'=>700);
$badge_size = array('width'=>250,'height'=>250);

$resized_avatar_image = resize_image($avatar_size['width'], $avatar_size['height'], $avatar_image, $img2_width, $img2_height);

$resized_right_side_image = resize_image($right_side_size['width'],  $right_side_size['height'], $right_side_image, $img3_width, $img3_height);

$resized_background_image = resize_image($background_size['width'],  $background_size['height'], $background_image, $img1_width, $img1_height);

$resized_badge_image =  resize_image($badge_size['width'],  $badge_size['height'], $badge_image, $img4_width, $img4_height);


imagecopymerge($resized_background_image, $resized_avatar_image, 750, 50, 0, 0, $avatar_size['width'], $avatar_size['height'], 100);

imagecopymerge($resized_background_image, $resized_right_side_image, 0, 0, 0, 0, $right_side_size['width'], $right_side_size['height'], 100);

imagecopymerge($resized_background_image, $resized_badge_image, 150, 150, 0, 0, $badge_size['width'], $badge_size['height'], 100);





$blue = imagecolorallocate($resized_background_image, 0, 0, 255);
$red = imagecolorallocate($resized_background_image, 255, 0, 0);

 $font_path = 'C:\xampp\htdocs\php-gd\chess-demo\assets\OpenSans-Bold.ttf';
 imagettftext($resized_background_image, 25, 0, 750, 300, $blue,$font_path, "Ahmed");
imagettftext($resized_background_image, 25, 0, 600, 350, $blue,$font_path, "Solved 10 puzzles in 5 minutes");
imagettftext($resized_background_image, 25, 0, 750, 400, $red,$font_path, "Puzzle Rush");

imagettftext($resized_background_image, 50, 0, 260, 295, $red,$font_path, "3");

header('Content-Type: image/png');
imagejpeg($resized_background_image);
imagedestroy($resized_background_image);



function resize_image($new_width, $new_height, $image, $width, $height) {
    $new_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    return $new_image;
}
