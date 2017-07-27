<?php

//include "../../includes/db.php";

function confirmQuery($result) 
{
    global $connectionToDB;
    if(!$result) {
        die ("Query failed: " . mysqli_error($connectionToDB));
    }
}


function createCategory()
{
    global $connectionToDB;
    if(isset($_POST['submit'])) {                               
        $newCategoryName = $_POST['category_title'];
        if($newCategoryName == " " || empty($newCategoryName)) {
            echo "Enter a new category name!";
        } else {
            $newCategoryQuery = "INSERT INTO categories(cat_title) VALUE ('{$newCategoryName}') ";
            $createCategoryQuery = mysqli_query($connectionToDB, $newCategoryQuery);
            if(!$createCategoryQuery) {
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

    while($row = mysqli_fetch_assoc($selectAllCategories)){
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
    if(isset($_GET['delete'])){
        $deleteCategoryId = $_GET['delete'];

        $deleteCategoryQuery = "DELETE FROM categories WHERE cat_id = {$deleteCategoryId} ";
        $deleteCategoryAction = mysqli_query($connectionToDB, $deleteCategoryQuery);

        if(!$deleteCategoryAction) {
           die('Could not delete the category ' . mysqli_error($connectionToDB));
        } else {
           header("location: categories.php");
        }
    }
    
}

?>