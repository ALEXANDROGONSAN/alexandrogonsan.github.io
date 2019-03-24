<?php

$ch = curl_init();

function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$dom = new DOMDocument();


$data_curl = file_get_contents_curl("http://alexandrogonsan.cf/t/webservice.php");
$dom->loadHTML($data_curl);
$data_curl_dom = ($dom->getElementsByTagName("body"))[0]->nodeValue;


$data = file_get_contents("http://alexandrogonsan.cf/t/webservice.php");
$dom->loadHTML($data);
$elements = $dom->getElementsByTagName("body");
$data_dom = "";
foreach ($elements as $key => $element) {
	# code...
	$data_dom = $element->nodeValue;
	break;
}


$dom->load("http://alexandrogonsan.cf/t/webservice.php");
$data_dom_direto = ($dom->getElementsByTagName("body"))[0]->nodeValue;

 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<textarea rows="4" cols="150">
    <?php echo var_dump(json_decode($data_curl,true)); ?>
</textarea><br>

<textarea rows="4" cols="150">
    <?php echo var_dump(json_decode($data_curl_dom,true)); ?>
</textarea><br>

<textarea rows="4" cols="150">
	<?php echo var_dump(json_decode($dom->documentElement->nodeValue,true)); ?>
</textarea><br>

<textarea rows="4" cols="150">
	<?php echo var_dump(json_decode($data_dom_direto,true)); ?>
</textarea><br>

<textarea rows="4" cols="150">
	<?php echo var_dump(json_decode($data_dom,true)); ?>
</textarea><br>

<textarea rows="4" cols="150">
	<?php echo var_dump(json_decode($data,true)); ?>
</textarea><br>

</body>
</html>