<?php //search engine

if (isset($_POST['search'])) {
    $searchRequest = ($_POST['search']);
    $searchQuery = "SELECT * FROM posts WHERE post_tags LIKE '%$searchRequest%' ";
    $searchInDB = queryToDB($query);
    $searchResultsCount = mysqli_num_rows($searchInDB);
    echo $searchResultsCount . " results found";
}
