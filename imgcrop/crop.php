
<?php
echo "<pre>";
print_r($_POST);
//echo $filename = $_FILES['image']['name'];

// Get the file information
    $fileName   = basename($_FILES["image"]["name"]);
    $fileTmp    = $_FILES["image"]["tmp_name"];
    $fileType   = $_FILES["image"]["type"];
    $fileSize   = $_FILES["image"]["size"];
    $fileExt    = substr($fileName, strrpos($fileName, ".") + 1);
    
    // Specify the images upload path
    $largeImageLoc = 'upload/'.$fileName;
    $thumbImageLoc = 'thumb/'.$fileName;

// If everything is ok, try to upload file
    
        if(move_uploaded_file($fileTmp, $largeImageLoc)){
            // File permission
            chmod($largeImageLoc, 0777);
            
            // Get dimensions of the original image
            list($width_org, $height_org) = getimagesize($largeImageLoc);
            
            // Get image coordinates
            $x = (int) $_POST['x1'];
            $y = (int) $_POST['y1'];
            $width = (int) $_POST['w'];
            $height = (int) $_POST['h'];

            //$width = 200;
            //$height = 200;

            // Define the size of the cropped image
            $width_new = $width;
            $height_new = $height;
            
            // Create new true color image
            $newImage = imagecreatetruecolor($width_new, $height_new);

            //$source = imagecreatefrompng($largeImageLoc);
            
            // Create new image from file
            switch($fileType) {
                case "image/gif":
                    $source = imagecreatefromgif($largeImageLoc); 
                    break;
                case "image/pjpeg":
                case "image/jpeg":
                case "image/jpg":
                    $source = imagecreatefromjpeg($largeImageLoc); 
                    break;
                case "image/png":
                case "image/x-png":
                    $source = imagecreatefrompng($largeImageLoc); 
                    break;
            }
            
            // Copy and resize part of the image
            imagecopyresampled($newImage, $source, 0, 0, $x, $y, $width_new, $height_new, $width, $height);

            //imagepng($newImage, $thumbImageLoc);  
            
            // Output image to file
            switch($fileType) {
                case "image/gif":
                    imagegif($newImage, $thumbImageLoc); 
                    break;
                case "image/pjpeg":
                case "image/jpeg":
                case "image/jpg":
                    imagejpeg($newImage, $thumbImageLoc, 90); 
                    break;
                case "image/png":
                case "image/x-png":
                    imagepng($newImage, $thumbImageLoc);  
                    break;
            }
            
            // Destroy image
            imagedestroy($newImage);

            // Display cropped image
            echo 'CROPPED IMAGE:<br/><img src="'.$thumbImageLoc.'"/>';
        }
        else{
            $error = "Sorry, there was an error uploading your file.";
        }
    


// Display error
echo $error;


exit;




// Create an image from given image 
$im = imagecreatefrompng( 
'https://cdncontribute.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-9.png'); 
  
// find the size of image 
$size = min(imagesx($im), imagesy($im)); 
  
// Set the crop image size  
$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 250, 'height' => 150]); 
if ($im2 !== FALSE) { 
    header("Content-type: image/png"); 
       imagepng($im2); 
    imagedestroy($im2); 
} 
imagedestroy($im);

exit;

 /*$fileName = "/upload";

$file = $_FILES['image']['name'];
echo $cropped = "cropped_" . $file;
$image = new Imagick($file);
$image->cropImage($_POST["w"], $_POST["h"], $_POST["x1"], $_POST["y1"]);
$image->writeImage($cropped);
echo $cropped;*/

/*$data = $_FILES['image']['name'];
$imageName = time().'.png';
file_put_contents('upload/'.$imageName, $data);*/


if(isset($_POST['submit'])) {
     
    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
 
        if(!file_exists('images')) {
            mkdir('images', 0755);
        }
 
        $filename = $_FILES['image']['name'];
        $filepath = 'images/'. $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $filepath);
         
        if(!file_exists('images/crop')) {
            mkdir('images/crop', 0755);
        }
 
        // crop image
        $img = $filepath;
        $croppath = 'images/crop/'. $filename;
 
        $img->crop($_POST['w'], $_POST['h'], $_POST['x1'], $_POST['y1']);
        $img->save($croppath);
 
        echo "<img src='". $croppath ."' />";
    }
}


?>