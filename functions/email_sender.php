<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$insertemail = $_POST['workEmail'];
		$insetrname = $_POST['firstName']." ".$_POST['lastName'];
		$inserttext = $_POST['word_count'];
		$insertcompany= $_POST['companyName'];
	$body = [
		'Messages' => [
			[
			'From' => [
				'Email' => $insertemail,
				'Name' => ucfirst($insetrname) 
			],
			'To' => [
				[
					'Email' => "medicaleyescompany@gmail.com",
					'Name' => "Medicaleyes"
				]
			],
			'Subject' => "Contact request",
			'HTMLPart' => "<strong>COMPANY NAME: </strong> ".$insertcompany."<br><br>". $inserttext
			]
		]
	];
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json')
	);
	curl_setopt($ch, CURLOPT_USERPWD, "c4eb73e026d4196d028de98120a24bbd:b15a942d1bb6985c06e8cb0306e9b2dc");
	$server_output = curl_exec($ch);
	echo $server_output;
	curl_close ($ch);
	
	$response = json_decode($server_output);
	if ($response->Messages[0]->Status == 'success') {
		header("location: ../home");
	} 

}
?>
</body>
</html>