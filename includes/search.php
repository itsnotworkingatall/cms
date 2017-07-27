<?php //search engine  

    if(isset($_POST['search'])){
        $searchRequest = ($_POST['search']);
        $searchQuery = "SELECT * FROM posts WHERE post_tags LIKE '%$searchRequest%' ";
        $searchInDB = mysqli_query($connectionToDB, $searchQuery);
        
        if(!$searchInDB) {
            die('Query Failed ' . mysqli_error($connectionToDB));
        } else {
            $searchResultsCount = mysqli_num_rows($searchInDB);
            echo $searchResultsCount . " results found";
        }       
    }   

?>