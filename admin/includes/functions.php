<?php

function queryToDB($query)
{
    global $connectionToDB;
    $select = mysqli_query($connectionToDB, $query);
    if (!$select) {
        die("Query failed: " . mysqli_error($connectionToDB));
    } else {
        return $select;
    }
}


function counter($result)
{
    global $connectionToDB;
    $query = "SELECT * FROM {$result} ";
    $select = mysqli_query($connectionToDB, $query);
    confirmQuery($select);
    $result = mysqli_num_rows($select);
    return $result;
}

function confirmQuery($result)
{
    global $connectionToDB;
    if (!$result) {
        die("Query failed: " . mysqli_error($connectionToDB));
    }
}


function createCategory()
{
    global $connectionToDB;
    if (isset($_POST['submit'])) {
        $newCategoryName = $_POST['category_title'];
        if ($newCategoryName == " " || empty($newCategoryName)) {
            echo "Enter a new category name!";
        } else {
            $newCategoryQuery = "INSERT INTO categories(cat_title) VALUE ('{$newCategoryName}') ";
            $createCategoryQuery = mysqli_query($connectionToDB, $newCategoryQuery);
            if (!$createCategoryQuery) {
                die("category was not created " . mysqli_error($connectionToDB));
            }
        }
    }
}

function findAllCAtegories()
{
    global $connectionToDB;
    $query = "SELECT * FROM categories";
    $selectAllCategories = mysqli_query($connectionToDB, $query);

    while ($row = mysqli_fetch_assoc($selectAllCategories)) {
        $categoryId = $row['cat_id'];
        $categoryTitle = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$categoryId}</td>";
        echo "<td>{$categoryTitle}</td>";
        echo "<td><a href='categories.php?edit={$categoryId}'>Edit</td>";
        echo "<td><a href='categories.php?delete={$categoryId}'>Delete</td>";
        echo "</tr>";
    }
}

function deleteCategory()
{
    global $connectionToDB;
    if (isset($_GET['delete'])) {
        $deleteCategoryId = $_GET['delete'];

        $deleteCategoryQuery = "DELETE FROM categories WHERE cat_id = {$deleteCategoryId} ";
        $deleteCategoryAction = mysqli_query($connectionToDB, $deleteCategoryQuery);

        if (!$deleteCategoryAction) {
            die('Could not delete the category ' . mysqli_error($connectionToDB));
        } else {
            header("location: categories.php");
        }
    }

}

function create_image()
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

    //header('Content-Type: image/png'); // setting header so it opens in a browser without creating a file.

    //uncomment two lines below to create a png file
    $imageFileTimestamp = date("U") + rand(0, 255);
    $imageFileName = "image-" . $imageFileTimestamp .".png";
    $imageFilePath = "C:\\xampp\htdocs\cms\images\\" . $imageFileName;
    imagepng($imgH, $imageFilePath);

    imagedestroy($imgH);//cleaning up the memory
    return $imageFileName;
}

function getUserNameById($postAuthorId) //takes user ID, returns full name
{
    $getAuthor = "SELECT * FROM users WHERE user_id = {$postAuthorId} ";
    $getPostAuthor = queryToDB($getAuthor);

    while ($row = mysqli_fetch_assoc($getPostAuthor)) {
        $authorFName = $row['user_first_name'];
        $authorLName = $row['user_last_name'];
    }

    $postAuthor = $authorFName . " " . $authorLName;

    return $postAuthor;
}

function escapeString($string)
{
    global $connectionToDB;
    $string = mysqli_real_escape_string($connectionToDB, $string);
    return $string;
}
