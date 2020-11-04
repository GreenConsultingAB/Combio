<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
	 <!--<link rel="stylesheet" href="style.css"> -->
    <title></title>
</head>
<body>
#testtetetete
	<?php

			ini_set('display_errors', 1);

			ini_set('display_startup_errors', 1);

			error_reporting(E_ALL);



			$cookiepath = "/tmp/cookies.txt";

			$tmeout=3600; // (3600=1hr)



	// här sätter ni er domän

			$baseurl= 'https://greenconsultingab.erpnext.com/';



			try{

			  $ch = curl_init($baseurl.'api/method/login');

			} catch (Exception $e) {

			  echo 'Caught exception: ',  $e->getMessage(), "\n";

			}



			curl_setopt($ch,CURLOPT_POST, true);



	// Här sätter ni era login-data
			curl_setopt($ch,CURLOPT_POSTFIELDS, '{"usr":"greenconsultingab@hotmail.com", "pwd":"Greenconsulting2020"}');


			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));

			curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

			curl_setopt($ch,CURLOPT_COOKIEJAR, $cookiepath);

			curl_setopt($ch,CURLOPT_COOKIEFILE, $cookiepath);

			curl_setopt($ch,CURLOPT_TIMEOUT, $tmeout);

			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);



			$response = curl_exec($ch);

			$response = json_decode($response,true);



			$error_no = curl_errno($ch);

			$error = curl_error($ch);

			curl_close($ch);




			if(!empty($error_no)){

			  echo "<div style='background-color:red'>";

			  echo '$error_no<br>';

			  var_dump($error_no);

			  echo "<hr>";



			  echo '$error<br>';

			  var_dump($error);

			  echo "<hr>";

			  echo "</div>";



			}



			echo "<div style='background-color:lightgray; border:1px solid black'>";


			echo '$response<br><pre>';


				echo print_r($response)."<br>";

			echo "</pre></div>";





			$ch = curl_init($baseurl.'/api/resource/Patient');

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));

			curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

			curl_setopt($ch,CURLOPT_COOKIEJAR, $cookiepath);

			curl_setopt($ch,CURLOPT_COOKIEFILE, $cookiepath);

			curl_setopt($ch,CURLOPT_TIMEOUT, $tmeout);

			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);


			$response = curl_exec($ch);

			$response = json_decode($response,true);



			$error_no = curl_errno($ch);

			$error = curl_error($ch);

			curl_close($ch);




			if(!empty($error_no)){

			  echo "<div style='background-color:red'>";

			  echo '$error_no<br>';

			  var_dump($error_no);

			  echo "<hr>";



			  echo '$error<br>';

			  var_dump($error);

			  echo "<hr>";

			  echo "</div>";



			}
			echo '<br><pre>';


				echo print_r($response)."<br>";

			echo "</pre></div>";

			$pdo = new PDO('mysql:dbname=a19majgu_ITORGPROJEKT;host=localhost', 'sqllab', 'Tomten2009');
			$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );




			foreach($response as $blabla){
					foreach($blabla as $response){

								$namnet =$response['name'];
								$querystrings="CALL Insertpatient('$namnet');";
								$stmt = $pdo->prepare($querystrings);
								$stmt->execute();  
								
					}
			} 
							$querystrings='SELECT * FROM Patient';
							$stmt = $pdo->prepare($querystrings);
						#	$stmt->bindParam(':name', $response["name"]);	
							$stmt->execute();  
							echo "<table style='border-collapse:collapse;'><th><tr>namn över personer i vår databas</tr></th>";
							foreach($stmt as $key => $row){
							echo "<tr><td>";
							echo $row['Namn'];
							echo "</td></tr>";
							}echo "</table>";


	?>

</body>
</html>
