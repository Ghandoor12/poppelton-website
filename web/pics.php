<?php

$dogType = $_GET['type'];


?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" href="myStylesheet.css">
<title>Display the Pic of the dog</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<p><a href="main.php"class="link_button"><<< Back to list</a></p>

<?php
	echo "<div class ='center'>";

try {
$api_url = "https://dog.ceo/api/breed/{$dogType}/images/random";
$json_data = file_get_contents($api_url);
}catch(Exception $err){
	echo "<h2>owner did not upload his dog pic</h2>";
}
if($json_data === false)
{
  echo "<h2>owner did not upload his dog pic</h2>";
}
else
{
$response_data = json_decode($json_data);
$imageData = base64_encode(file_get_contents($response_data->message));
echo '<img src="data:image/jpeg;base64,'.$imageData.'">';

}

echo "</div>";

?>
</body>
</html>
