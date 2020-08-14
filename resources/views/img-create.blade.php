<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php
ob_start();
// Create the size of image or blank image 
$image = imagecreate(500, 300); 
$background_color = imagecolorallocate($image,  0, 153, 0); 
imagefill($image, 0, 0, $background_color); 
header('Content-type: image/png'); 
imagepng($image); 
$rawImageBytes = ob_get_clean();
echo "<img src='data:image/png;base64," . base64_encode( $rawImageBytes ) . "' />";

?>
</body>
</html>