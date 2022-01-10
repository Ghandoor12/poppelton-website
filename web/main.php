<?php

include "connect.php";

//select all the topDogs
$query =
"SELECT owners.id as ownersID,
owners.name as ownersName  ,
dogs.name as name ,
breeds.name as breed,
count(entries.dog_id) as noOfEntries ,
avg(entries.score) as averageScore
FROM `entries`
INNER JOIN dogs ON entries.dog_id = dogs.id
INNER JOIN breeds ON breeds.id = dogs.breed_id
INNER JOIN owners ON dogs.owner_id = owners.id
group by dog_id  HAVING noOfEntries>1 order by averageScore DESC LIMIT 10;";

$resultset = $conn->query($query);
$topDogs = $resultset->fetchAll();



$query = "SELECT COUNT(id) as noOfOwners FROM owners";
$resultset = $conn->query($query);
$NoOfOwners = $resultset->fetch();



$query = "SELECT COUNT(id) as noOfDogs FROM dogs";
$resultset = $conn->query($query);
$dogs = $resultset->fetch();


$query = "SELECT COUNT(id) as noOfEvents FROM events";
$resultset = $conn->query($query);
$events = $resultset->fetch();
$conn=NULL;
?>


<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="myStylesheet.css">
<title>Top 10 Dogs</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
	<ul>
<?php
echo "<div class='boxed'><h1>Welcome to Poppleton Dog Show! This year {$NoOfOwners["noOfOwners"]} owners entered {$dogs["noOfDogs"]} dogs in {$events["noOfEvents"]}
events!</h1></div>";

echo "<div class = 'subheading'>	";
echo "<h2>Top Ten Dogs With Highest Average Score:</h2>";
echo "</div>";

//loop over the array of dogs
foreach ($topDogs as $dog) {
echo "<ul>";
		$str = strtolower("{$dog["breed"]}");
    echo "<h3><li><a href='pics.php?type={$str}'>";
    echo "<p>Dog Name: {$dog["name"]} </p>";
    echo "</a></li>";
    echo "<p>Breed: {$dog["breed"]} </p>";
		echo "<p>Average Score: {$dog["averageScore"]} </p>";
		echo " <button class='pulse'><a href='Owners.php?id={$dog["ownersID"]}'> Owner Name: {$dog["ownersName"]} </a> </button></h3>";

echo "</ul>";
}
?>
</ul>
</body>
</link>
</html>
