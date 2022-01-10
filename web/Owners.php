<?php
include "connect.php";


$owners = $_GET['id'];

$stmt = $conn->prepare("SELECT name , address , email , phone FROM owners WHERE id = :id");
$stmt->bindValue(':id',$owners);
$stmt->execute();
$owner=$stmt->fetch();
$conn=NULL;

?>



<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="myStylesheet.css">
<title>Display the details for a Owner</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<p><a href="main.php"class="link_button"><<< Back to list</a></p>

<?php

//simple validation to see if we found a country
if($owner){
	echo "<div class ='center'>";
	echo "<h1>{$owner['name']}</h1>";
	echo "Email: " ." <a href='mailto: " . $owner['email'] . " '>"  . $owner['email'] ;
	echo "</a>";
	echo "<p>Address: {$owner['address']}</p>";
	echo "<p>Phone Number: {$owner['phone']}</p>";
	echo "</div>";
}
else
{
	echo "<p>Can't find any records.</p>";
}

?>
</body>
</html>
