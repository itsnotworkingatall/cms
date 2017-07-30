<?php

function create_image() //creates a random image cms/images/image-"unix time stamp".png and returns a path to it.
{
    $squareSize = 100;
    $imgSize = $squareSize * 2;
    $img = imagecreatetruecolor($imgSize, $imgSize) or die("Cannot Initialize new GD image stream");
    $bkgColor = imagecolorallocate($img, rand(180, 255), rand(180, 255), rand(180, 255));
    imagefilledrectangle($img, 0, 0, $imgSize, $imgSize, $bkgColor);

    for ($i = 1; $i <= 5; $i++) { //drawing $i squares in loop

        $color1 = imagecolorallocate($img, rand(0, 170), rand(0, 170), rand(0, 170)); //setting a colour of the square
        imagefilledrectangle($img, rand(1, 50), rand(1, 50), rand(30, 100), rand(30, 100), $color1); //drawing the rectangle
    }

    imagepng($img, "image.png"); //saving newly generated image into a file
    $imgH = imagecreatefrompng("image.png"); // opening newly generated image from file
    imageflip($imgH, IMG_FLIP_HORIZONTAL); // flipping opened image
    imagecopy($img, $imgH, $squareSize, 0, $squareSize, 0, $squareSize, $squareSize); //copying flipped part into the saved file.

    imagepng($img, "imageH.png"); //saving flipped and copied image into a file

    imagedestroy($img); //cleaning up the memory
    imagedestroy($imgH); //cleaning up the memory

    $imgV = imagecreatefrompng("imageH.png"); //opening flipped and copied image from file
    imageflip($imgV, IMG_FLIP_VERTICAL); // flipping it vertically
    imagepng($imgV, "imageV.png"); //saving upside down image into a file
    imagedestroy($imgV);//cleaning up the memory

    $imgH = imagecreatefrompng("imageH.png");
    $imgV = imagecreatefrompng("imageV.png");
    imagecopy($imgH, $imgV, 0, $squareSize, 0, $squareSize, $squareSize*2, $squareSize); //copying lower half to an upper one.

    //header('Content-Type: image/png'); // uncomment to set a header so it opens in a browser without creating a file.

    //comment 4 lines below not to create a png file
    $imageFileTimestamp = date("U") + rand(0, 255);
    $imageFileName = "image-" . $imageFileTimestamp .".png";
    $imageFilePath = "../../images/" . $imageFileName; //here you may need to modify the path, depending on the function location
    imagepng($imgH, $imageFilePath);

    //imagepng($imgH); //uncomment this line if you don't want to create a png file

    imagedestroy($imgH);//cleaning up the memory
    return $imageFilePath;
}

$image = create_image();
print "<img src=".$image.">";
